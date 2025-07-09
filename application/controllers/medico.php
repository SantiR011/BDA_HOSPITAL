<?php

if (!defined('BASEPATH'))

	exit('No direct script access allowed');




class medico extends CI_Controller
{





	function __construct()
	{

		parent::__construct();

		$this->load->database();

		/*cache control*/

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

	}



	/***Default function, redirects to login page if no admin logged in yet***/

	public function index()
	{

		if ($this->session->userdata('medico_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		if ($this->session->userdata('medico_login') == 1)

			redirect(base_url() . 'index.php?medico/dashboard', 'refresh');

	}



	/***medico DASHBOARD***/

	function dashboard()
	{
		if ($this->session->userdata('medico_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		$medico_id = $this->session->userdata('medico_id');
		echo 'Médico ID desde sesión: ' . $medico_id;


		$this->db->select('cita.*, paciente.nombres as paciente_nombre, paciente.apellidos as paciente_apellido');
		$this->db->from('cita');
		$this->db->join('paciente', 'paciente.numero_id = cita.paciente_id');
		$this->db->where('cita.medico_id', $medico_id);
		$this->db->where('cita.estado_id', 1); // Solo citas programadas
		$citas = $this->db->get()->result_array();

		$page_data['citas'] = $citas;
		$page_data['page_name'] = 'dashboard';
		$page_data['page_title'] = 'Cuadro de mandos médico';

		$this->load->view('index', $page_data);
	}








	/***Manage pacientes**/

	function gestionar_paciente($param1 = '', $param2 = '', $param3 = '')
	{
		// Solo permite el acceso a usuarios con sesión activa como médico
		if ($this->session->userdata('medico_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		if ($param1 == 'create') {
			$data['tipo_id'] = $this->input->post('tipo_id');
			$data['numero_id'] = $this->input->post('numero_id');
			$data['nombres'] = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$data['correo'] = $this->input->post('correo');
			$data['contrasena'] = $this->input->post('contrasena');
			$data['direccion'] = $this->input->post('direccion');
			$data['municipio_id'] = $this->input->post('municipio_id');
			$data['telefono_principal'] = $this->input->post('telefono_principal');
			$data['fecha_nac'] = $this->input->post('fecha_nac');

			$this->db->insert('paciente', $data);

			// Opcional: enviar correo
			$this->email_model->account_opening_email('paciente', $data['correo']);

			$this->session->set_flashdata('flash_message', 'Paciente registrado correctamente.');
			redirect(base_url() . 'index.php?medico/gestionar_paciente', 'refresh');
		}

		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['tipo_id'] = $this->input->post('tipo_id');
			$data['numero_id'] = $this->input->post('numero_id');
			$data['nombres'] = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$data['correo'] = $this->input->post('correo');
			$data['contrasena'] = $this->input->post('contrasena');
			$data['direccion'] = $this->input->post('direccion');
			$data['municipio_id'] = $this->input->post('municipio_id');
			$data['telefono_principal'] = $this->input->post('telefono_principal');
			$data['fecha_nac'] = $this->input->post('fecha_nac');

			$this->db->where('numero_id', $param3);
			$this->db->update('paciente', $data);

			$this->session->set_flashdata('flash_message', 'Datos del paciente actualizados correctamente.');
			redirect(base_url() . 'index.php?medico/gestionar_paciente', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('paciente', array(
				'numero_id' => $param2
			))->result_array();
		}

		if ($param1 == 'delete') {
			$this->db->where('numero_id', $param2);
			$this->db->delete('paciente');
			$this->session->set_flashdata('flash_message', 'Paciente eliminado correctamente.');
			redirect(base_url() . 'index.php?medico/gestionar_paciente', 'refresh');
		}

		// Carga los datos para la vista
		$page_data['page_name'] = 'gestionar_paciente';
		$page_data['page_title'] = 'Gestionar pacientes';
		$page_data['pacientes'] = $this->db->get('paciente')->result_array();

		$this->load->view('index', $page_data);
	}




	/***MANAGE APPOINTMENTS******/

	public function gestionar_cita($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('medico_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        // Crear cita
        if ($param1 == 'create') {
            $medico_id = $this->input->post('medico_id');
            $paciente_id = $this->input->post('paciente_id');
            $especialidad_id = $this->input->post('especialidad_id');
            $lugar_id = $this->input->post('lugar_id');
            $estado_id = $this->input->post('estado_id');
            $fecha_hora = $this->input->post('fecha_hora');

            // Validar hora entre 7:00 AM y 10:00 PM
            $hora_cita = date('H:i:s', strtotime($fecha_hora));
            $minuto = date('i', strtotime($fecha_hora));
            if ($minuto != '00' && $minuto != '30') {
                $this->session->set_flashdata('error', 'Las citas solo pueden agendarse cada 30 minutos (ej: 08:00, 08:30, 09:00, etc).');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            if ($hora_cita < '07:00:00' || $hora_cita > '22:00:00') {
                $this->session->set_flashdata('error', 'La cita debe estar entre las 7:00 AM y las 10:00 PM.');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            // Validar que el médico no tenga otra cita a esa hora exacta
            $existe = $this->db
                ->where('medico_id', $medico_id)
                ->where('fecha_hora', $fecha_hora)
                ->count_all_results('cita');
            if ($existe > 0) {
                $this->session->set_flashdata('error', 'El médico ya tiene una cita en esa fecha y hora.');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            // Validar límite mensual (si no es medicina general)
            $especialidad = $this->db->get_where('especialidad', ['especialidad_id' => $especialidad_id])->row();
            if (strtolower(trim($especialidad->nombre)) != 'medicina general') {
                $inicio_mes = date('Y-m-01 00:00:00', strtotime($fecha_hora));
                $fin_mes = date('Y-m-t 23:59:59', strtotime($fecha_hora));

                $this->db->where('paciente_id', $paciente_id);
                $this->db->where('especialidad_id', $especialidad_id);
                $this->db->where('fecha_hora >=', $inicio_mes);
                $this->db->where('fecha_hora <=', $fin_mes);
                $conteo = $this->db->count_all_results('cita');

                if ($conteo >= 2) {
                    $this->session->set_flashdata('error', 'No se pueden asignar más de dos citas de esta especialidad en el mismo mes para este paciente.');
                    redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                    return;
                }
            }

            // Validar que la fecha no esté en el pasado
            if (strtotime($fecha_hora) < strtotime(date('Y-m-d H:i:s'))) {
                $this->session->set_flashdata('error', 'No se puede programar una cita en una fecha y hora anterior a la actual.');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            // Guardar la cita
            $data = [
                'medico_id' => $medico_id,
                'paciente_id' => $paciente_id,
                'especialidad_id' => $especialidad_id,
                'lugar_id' => $lugar_id,
                'estado_id' => $estado_id,
                'fecha_hora' => $fecha_hora,
                'fecha_registro' => date('Y-m-d H:i:s'),
                'fecha_actualizacion' => date('Y-m-d H:i:s'),
            ];

            $this->db->insert('cita', $data);
            $this->session->set_flashdata('flash_message', 'Cita creada correctamente');
            redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
        }

        // Editar cita
        if ($param1 == 'edit' && $param2 == 'do_update') {

            // Verificar que la cita tenga estado 1
            $cita_existente = $this->db->get_where('cita', ['cita_id' => $param3])->row();
            if (!$cita_existente || $cita_existente->estado_id != 1) {
                $this->session->set_flashdata('error', 'Solo se pueden editar citas que estén programadas (estado 1).');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            $fecha_hora = $this->input->post('fecha_hora');

            // Validar que no sea en el pasado
            if (strtotime($fecha_hora) < strtotime(date('Y-m-d H:i:s'))) {
                $this->session->set_flashdata('error', 'No se puede actualizar una cita a una fecha y hora anterior a la actual.');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            // Validar rango horario
            $hora_cita = date('H:i:s', strtotime($fecha_hora));
            $minuto = date('i', strtotime($fecha_hora));
            if ($minuto != '00' && $minuto != '30') {
                $this->session->set_flashdata('error', 'Las citas solo pueden agendarse cada 30 minutos (ej: 08:00, 08:30, 09:00, etc).');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            if ($hora_cita < '07:00:00' || $hora_cita > '22:00:00') {
                $this->session->set_flashdata('error', 'La cita debe estar entre las 7:00 AM y las 10:00 PM.');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            // Validar que el médico no tenga otra cita en esa hora (excluyendo la actual)
            $medico_id = $this->input->post('medico_id');
            $conflicto = $this->db
                ->where('medico_id', $medico_id)
                ->where('fecha_hora', $fecha_hora)
                ->where('cita_id !=', $param3)
                ->count_all_results('cita');

            if ($conflicto > 0) {
                $this->session->set_flashdata('error', 'El médico ya tiene una cita en esa fecha y hora.');
                redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
                return;
            }

            $data['paciente_id'] = $this->input->post('paciente_id');
            $data['medico_id'] = $medico_id;
            $data['especialidad_id'] = $this->input->post('especialidad_id');
            $data['lugar_id'] = $this->input->post('lugar_id');
            $data['estado_id'] = $this->input->post('estado_id');
            $data['fecha_hora'] = $fecha_hora;
            $data['fecha_actualizacion'] = date('Y-m-d H:i:s');

            $this->db->where('cita_id', $param3);
            $this->db->update('cita', $data);
            $this->session->set_flashdata('flash_message', 'Cita actualizada correctamente');
            redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
        }


        // Obtener cita para edición
        if ($param1 == 'edit') {
            $page_data['edit_profile'] = $this->db->get_where('cita', ['cita_id' => $param2])->result_array();
        }

        // Eliminar cita
        if ($param1 == 'delete') {
            $this->db->where('cita_id', $param2);
            $this->db->delete('cita');
            $this->session->set_flashdata('flash_message', 'Cita eliminada correctamente');
            redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
        }

        // Datos para vista
        $page_data['page_name'] = 'gestionar_cita';
        $page_data['page_title'] = 'Gestionar citas';
        $page_data['citas'] = $this->db->get('cita')->result_array();
        $page_data['pacientes'] = $this->db->get('paciente')->result_array();
        $page_data['medicos'] = $this->db->get('medico')->result_array();
        $page_data['lugares'] = $this->db->get('lugar')->result_array();
        $page_data['especialidades'] = $this->db->get('especialidad')->result_array();
        $page_data['estados'] = $this->db->get('estado_cita')->result_array();

        $this->load->view('index', $page_data);
    }







	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/

	function gestionar_perfil($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('medico_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		if ($param1 == 'update_profile_info') {
			$data['tipo_id'] = $this->input->post('tipo_id');
			$data['numero_id'] = $this->input->post('numero_id');
			$data['nombres'] = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$data['correo'] = $this->input->post('correo');
			$data['direccion'] = $this->input->post('direccion');
			$data['municipio_id'] = $this->input->post('municipio_id');
			$data['telefono_principal'] = $this->input->post('telefono_principal');
			$data['fecha_nac'] = $this->input->post('fecha_nac');

			$this->db->where('numero_id', $this->session->userdata('numero_id'));
			$this->db->update('medico', $data);

			$this->session->set_flashdata('flash_message', 'Perfil actualizado correctamente');
			redirect(base_url() . 'index.php?medico/gestionar_perfil', 'refresh');
		}

		if ($param1 == 'change_password') {
			$password_actual = $this->input->post('password');
			$nuevo_password = $this->input->post('new_password');
			$confirmar_nuevo_password = $this->input->post('confirm_new_password');

			$medico = $this->db->get_where('medico', array(
				'numero_id' => $this->session->userdata('numero_id')
			))->row();

			if ($medico->contrasena == $password_actual) {
				if ($nuevo_password === $confirmar_nuevo_password) {
					$this->db->where('numero_id', $medico->numero_id);
					$this->db->update('medico', array('contrasena' => $nuevo_password));
					$this->session->set_flashdata('flash_message', 'Contraseña actualizada correctamente');
				} else {
					$this->session->set_flashdata('flash_message', 'Las nuevas contraseñas no coinciden');
				}
			} else {
				$this->session->set_flashdata('flash_message', 'Contraseña actual incorrecta');
			}

			redirect(base_url() . 'index.php?medico/gestionar_perfil', 'refresh');
		}

		$page_data['page_name'] = 'gestionar_perfil';
		$page_data['page_title'] = 'Gestionar perfil';
		$page_data['edit_profile'] = $this->db->get_where('medico', array(
			'numero_id' => $this->session->userdata('numero_id')
		))->result_array();

		$this->load->view('index', $page_data);
	}


}