<?php

if (!defined('BASEPATH'))

	exit('No direct script access allowed');



class Paciente extends CI_Controller
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

		if ($this->session->userdata('paciente_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		if ($this->session->userdata('paciente_login') == 1)

			redirect(base_url() . 'index.php?paciente/dashboard', 'refresh');

	}



	/***paciente DASHBOARD***/

	function dashboard()
{
    if ($this->session->userdata('paciente_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    $paciente_id = $this->session->userdata('numero_id'); // El paciente se identifica por numero_id

    // Obtener las citas del paciente logueado con estado 'programado' (estado_id = 1)
    $this->db->select('cita.*, medico.nombres as medico_nombre, medico.apellidos as medico_apellido');
    $this->db->from('cita');
    $this->db->join('medico', 'medico.numero_id = cita.medico_id');
    $this->db->where('cita.paciente_id', $paciente_id);
    $this->db->where('cita.estado_id', 1); // Solo citas programadas
    $citas = $this->db->get()->result_array();

    $page_data['citas'] = $citas;
    $page_data['page_name'] = 'dashboard';
    $page_data['page_title'] = 'Cuadro de mandos del paciente';

    $this->load->view('index', $page_data);
}




	/***VIEW APPOINTMENTS******/

	public function gestionar_cita($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('paciente_login') != 1)
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
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
                return;
            }

            if ($hora_cita < '07:00:00' || $hora_cita > '22:00:00') {
                $this->session->set_flashdata('error', 'La cita debe estar entre las 7:00 AM y las 10:00 PM.');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
                return;
            }

            // Validar que el médico no tenga otra cita a esa hora exacta
            $existe = $this->db
                ->where('medico_id', $medico_id)
                ->where('fecha_hora', $fecha_hora)
                ->count_all_results('cita');
            if ($existe > 0) {
                $this->session->set_flashdata('error', 'El médico ya tiene una cita en esa fecha y hora.');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
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
                    redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
                    return;
                }
            }

            // Validar que la fecha no esté en el pasado
            if (strtotime($fecha_hora) < strtotime(date('Y-m-d H:i:s'))) {
                $this->session->set_flashdata('error', 'No se puede programar una cita en una fecha y hora anterior a la actual.');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
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
            redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
        }

        // Editar cita
        if ($param1 == 'edit' && $param2 == 'do_update') {

            // Verificar que la cita tenga estado 1
            $cita_existente = $this->db->get_where('cita', ['cita_id' => $param3])->row();
            if (!$cita_existente || $cita_existente->estado_id != 1) {
                $this->session->set_flashdata('error', 'Solo se pueden editar citas que estén programadas (estado 1).');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
                return;
            }

            $fecha_hora = $this->input->post('fecha_hora');

            // Validar que no sea en el pasado
            if (strtotime($fecha_hora) < strtotime(date('Y-m-d H:i:s'))) {
                $this->session->set_flashdata('error', 'No se puede actualizar una cita a una fecha y hora anterior a la actual.');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
                return;
            }

            // Validar rango horario
            $hora_cita = date('H:i:s', strtotime($fecha_hora));
            $minuto = date('i', strtotime($fecha_hora));
            if ($minuto != '00' && $minuto != '30') {
                $this->session->set_flashdata('error', 'Las citas solo pueden agendarse cada 30 minutos (ej: 08:00, 08:30, 09:00, etc).');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
                return;
            }

            if ($hora_cita < '07:00:00' || $hora_cita > '22:00:00') {
                $this->session->set_flashdata('error', 'La cita debe estar entre las 7:00 AM y las 10:00 PM.');
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
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
                redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
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
            redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
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
            redirect(base_url() . 'index.php?paciente/gestionar_cita', 'refresh');
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







	/***MANAGE PRESCRIPTIONS******/

	function view_prescription($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('paciente_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');



		if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('prescription', array(

				'prescription_id' => $param2

			))->result_array();

		}

		$page_data['page_name'] = 'view_prescription';

		$page_data['page_title'] = ('Ver prescripción');

		$page_data['prescriptions'] = $this->db->get_where('prescription', array(

			'numero_id' => $this->session->userdata('numero_id')

		))->result_array();

		$this->load->view('index', $page_data);

	}



	/******VIEW DOCTOR LIST*****/

	function ver_medico()
	{
		if ($this->session->userdata('paciente_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		$page_data['page_name'] = 'ver_medico';
		$page_data['page_title'] = 'Listado de Médicos';
		$page_data['medicos'] = $this->db->get('medico')->result_array();
		$this->load->view('index', $page_data);
	}





	/******VIEW ADMIT HISTORY*****/

	function view_admit_history($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('paciente_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');



		$page_data['page_name'] = 'view_admit_history';

		$page_data['page_title'] = ('Ver el historial de admisiones');

		$page_data['bed_allotments'] = $this->db->get_where('bed_allotment', array(

			'numero_id' => $this->session->userdata('numero_id')

		))->result_array();

		$this->load->view('index', $page_data);

	}



	/******VIEW BLOOD BANK*****/

	function view_blood_bank($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('paciente_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');



		$page_data['page_name'] = 'view_blood_bank';

		$page_data['page_title'] = ('Ver Banco de Sangre');

		$page_data['blood_donors'] = $this->db->get('blood_donor')->result_array();

		$page_data['blood_bank'] = $this->db->get('blood_bank')->result_array();

		$this->load->view('index', $page_data);

	}



	/******MANAGE BILLING/ MAKE PAYMENT*****/

	function view_invoice($param1 = '', $param2 = '', $param3 = '')
	{

		//if($this->session->userdata('paciente_login')!=1)redirect(base_url().'index.php?login' , 'refresh');

		if ($param1 == 'make_payment') {

			$invoice_id = $this->input->post('invoice_id');

			$system_settings = $this->db->get_where('settings', array(

				'type' => 'paypal_email'

			))->row();

			$invoice_details = $this->db->get_where('invoice', array(

				'invoice_id' => $invoice_id

			))->row();



			/****TRANSFERRING USER TO PAYPAL TERMINAL****/

			$this->paypal->add_field('rm', 2);

			$this->paypal->add_field('no_note', 0);

			$this->paypal->add_field('item_name', $invoice_details->title);

			$this->paypal->add_field('amount', $invoice_details->amount);

			$this->paypal->add_field('custom', $invoice_details->invoice_id);

			$this->paypal->add_field('business', $system_settings->description);

			$this->paypal->add_field('notify_url', base_url() . 'index.php?paciente/view_invoice/paypal_ipn');

			$this->paypal->add_field('cancel_return', base_url() . 'index.php?paciente/view_invoice/paypal_cancel');

			$this->paypal->add_field('return', base_url() . 'index.php?paciente/view_invoice/paypal_success');



			$this->paypal->submit_paypal_post();

			// submit the fields to paypal

		}

		if ($param1 == 'paypal_ipn') {

			if ($this->paypal->validate_ipn() == true) {

				$ipn_response = '';

				foreach ($_POST as $key => $value) {

					$value = urlencode(stripslashes($value));

					$ipn_response .= "\n$key=$value";

				}

				$invoice_id = $_POST['custom'];

				$data['status'] = 'paid';

				$this->db->where('invoice_id', $invoice_id);

				$this->db->update('invoice', $data);



				$data2['transaction_id'] = rand(10000, 100000);

				$data2['invoice_id'] = $invoice_id;

				$data2['numero_id'] = $this->crud_model->get_type_name_by_id('invoice', $invoice_id, 'numero_id');

				$data2['payment_method'] = 'paypal';

				$data2['description'] = $ipn_response;

				$data2['amount'] = $this->crud_model->get_type_name_by_id('invoice', $invoice_id, 'amount');

				$data2['timestamp'] = strtotime(date("m/d/Y"));



				$this->db->insert('payment', $data2);

			}

		}

		if ($param1 == 'paypal_cancel') {

			$this->session->set_flashdata('flash_message', ('Payment Cancelled'));

			redirect(base_url() . 'index.php?paciente/view_invoice/', 'refresh');

		}

		if ($param1 == 'paypal_success') {

			$this->session->set_flashdata('flash_message', ('Payment Successfull'));

			redirect(base_url() . 'index.php?paciente/view_invoice/', 'refresh');

		}



		$page_data['page_name'] = 'view_invoice';

		$page_data['page_title'] = ('Ver factura');

		$page_data['invoices'] = $this->db->get_where('invoice', array(

			'numero_id' => $this->session->userdata('numero_id')

		))->result_array();

		$this->load->view('index', $page_data);

	}



	/******VIEW COMPLETED PAYMENT HISTORY*****/

	function payment_history($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('paciente_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');



		$page_data['page_name'] = 'payment_history';

		$page_data['page_title'] = ('Historial de pagos');

		$page_data['payments'] = $this->db->get_where('payment', array(

			'numero_id' => $this->session->userdata('numero_id')

		))->result_array();

		$this->load->view('index', $page_data);

	}



	/******VIEW OPERATION HISTORY*****/

	function view_operation_history($param1 = '', $param2 = '', $param3 = '')
	{

		if ($this->session->userdata('paciente_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');



		$page_data['page_name'] = 'view_operation_history';

		$page_data['page_title'] = ('Ver el historial de operaciones');

		$page_data['reports'] = $this->db->get_where('report', array(

			'numero_id' => $this->session->userdata('numero_id'),

			'type' => 'operation'

		))->result_array();

		$this->load->view('index', $page_data);

	}





	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/

	function gestionar_perfil($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('paciente_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');

		if ($param1 == 'update_profile_info') {
			$data['tipo_id'] = $this->input->post('tipo_id');
			$data['numero_id'] = $this->input->post('numero_id');
			$data['nombres'] = $this->input->post('nombres');
			$data['apellidos'] = $this->input->post('apellidos');
			$data['correo'] = $this->input->post('correo');
			$data['contrasena'] = $this->input->post('contrasena');
			$data['direccion'] = $this->input->post('direccion');
			$data['municipio_id'] = $this->input->post('municipio_id');
			$data['telefono_principal'] = $this->input->post('telefono_principal');

			$this->db->where('numero_id', $this->session->userdata('numero_id'));
			$this->db->update('paciente', $data);

			$this->session->set_flashdata('flash_message', 'Perfil actualizado correctamente');
			redirect(base_url() . 'index.php?paciente/gestionar_perfil', 'refresh');
		}

		if ($param1 == 'change_password') {
			$contrasena_actual = $this->input->post('password');
			$nueva_contrasena = $this->input->post('new_password');
			$confirmar_nueva_contrasena = $this->input->post('confirm_new_password');

			$paciente = $this->db->get_where('paciente', array(
				'numero_id' => $this->session->userdata('numero_id')
			))->row();

			if ($paciente->contrasena == $contrasena_actual) {
				if ($nueva_contrasena === $confirmar_nueva_contrasena) {
					$this->db->where('numero_id', $paciente->numero_id);
					$this->db->update('paciente', array('contrasena' => $nueva_contrasena));
					$this->session->set_flashdata('flash_message', 'Contraseña actualizada correctamente');
				} else {
					$this->session->set_flashdata('flash_message', 'Las nuevas contraseñas no coinciden');
				}
			} else {
				$this->session->set_flashdata('flash_message', 'Contraseña actual incorrecta');
			}

			redirect(base_url() . 'index.php?paciente/gestionar_perfil', 'refresh');
		}


		$page_data['page_name'] = 'gestionar_perfil';
		$page_data['page_title'] = 'Gestionar perfil';
		$page_data['edit_profile'] = $this->db->get_where('paciente', array(
			'numero_id' => $this->session->userdata('numero_id')
		))->result_array();

		$this->load->view('index', $page_data);
	}




}