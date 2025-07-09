<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*  
 *  Hospital Management system
 */

class Admin extends CI_Controller
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
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        if ($this->session->userdata('admin_login') == 1)
            redirect(base_url() . 'index.php?admin/dashboard', 'refresh');
    }

    /***ADMIN DASHBOARD***/
    function dashboard()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = ('Panel de administración');
        $this->load->view('index', $page_data);
    }

    // El resto de la función 'gestionar_especialidad' se mantiene igual ya que no interactúa con la tabla 'admin' ni 'email/correo'
    function gestionar_especialidad($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'create') {
            $data['nombre'] = $this->input->post('nombre');
            $data['descripcion'] = $this->input->post('descripcion');
            $this->db->insert('especialidad', $data);
            $this->session->set_flashdata('flash_message', 'Especialidad creada');
            redirect(base_url() . 'index.php?admin/gestionar_especialidad', 'refresh');
        }

        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['nombre'] = $this->input->post('nombre');
            $data['descripcion'] = $this->input->post('descripcion');
            $this->db->where('especialidad_id', $param3);
            $this->db->update('especialidad', $data);
            $this->session->set_flashdata('flash_message', 'Especialidad actualizada');
            redirect(base_url() . 'index.php?admin/gestionar_especialidad', 'refresh');

        } else if ($param1 == 'edit') {
            $page_data['edit_profile'] = $this->db->get_where('especialidad', array(
                'especialidad_id' => $param2
            ))->result_array();
        }

        if ($param1 == 'delete') {
            $this->db->where('especialidad_id', $param2);
            $this->db->delete('especialidad');
            $this->session->set_flashdata('flash_message', 'Especialidad eliminada');
            redirect(base_url() . 'index.php?admin/gestionar_especialidad', 'refresh');
        }

        $page_data['page_name'] = 'gestionar_especialidad';
        $page_data['page_title'] = 'Gestionar especialidades';
        $page_data['especialidades'] = $this->db->get('especialidad')->result_array();
        $this->load->view('index', $page_data);
    }


    public function gestionar_cita($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
                return;
            }

            if ($hora_cita < '07:00:00' || $hora_cita > '22:00:00') {
                $this->session->set_flashdata('error', 'La cita debe estar entre las 7:00 AM y las 10:00 PM.');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
                return;
            }

            // Validar que el médico no tenga otra cita a esa hora exacta
            $existe = $this->db
                ->where('medico_id', $medico_id)
                ->where('fecha_hora', $fecha_hora)
                ->count_all_results('cita');
            if ($existe > 0) {
                $this->session->set_flashdata('error', 'El médico ya tiene una cita en esa fecha y hora.');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
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
                    redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
                    return;
                }
            }

            // Validar que la fecha no esté en el pasado
            if (strtotime($fecha_hora) < strtotime(date('Y-m-d H:i:s'))) {
                $this->session->set_flashdata('error', 'No se puede programar una cita en una fecha y hora anterior a la actual.');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
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
            redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
        }

        // Editar cita
        if ($param1 == 'edit' && $param2 == 'do_update') {

            // Verificar que la cita tenga estado 1
            $cita_existente = $this->db->get_where('cita', ['cita_id' => $param3])->row();
            if (!$cita_existente || $cita_existente->estado_id != 1) {
                $this->session->set_flashdata('error', 'Solo se pueden editar citas que estén programadas (estado 1).');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
                return;
            }

            $fecha_hora = $this->input->post('fecha_hora');

            // Validar que no sea en el pasado
            if (strtotime($fecha_hora) < strtotime(date('Y-m-d H:i:s'))) {
                $this->session->set_flashdata('error', 'No se puede actualizar una cita a una fecha y hora anterior a la actual.');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
                return;
            }

            // Validar rango horario
            $hora_cita = date('H:i:s', strtotime($fecha_hora));
            $minuto = date('i', strtotime($fecha_hora));
            if ($minuto != '00' && $minuto != '30') {
                $this->session->set_flashdata('error', 'Las citas solo pueden agendarse cada 30 minutos (ej: 08:00, 08:30, 09:00, etc).');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
                return;
            }

            if ($hora_cita < '07:00:00' || $hora_cita > '22:00:00') {
                $this->session->set_flashdata('error', 'La cita debe estar entre las 7:00 AM y las 10:00 PM.');
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
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
                redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
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
            redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
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
            redirect(base_url() . 'index.php?admin/gestionar_cita', 'refresh');
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







    /***Manage medicos**/
    function gestionar_paciente($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            $this->email_model->account_opening_email('paciente', $data['correo']);
            $this->session->set_flashdata('flash_message', 'Paciente creado correctamente.');
            redirect(base_url() . 'index.php?admin/gestionar_paciente', 'refresh');
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
            redirect(base_url() . 'index.php?admin/gestionar_paciente', 'refresh');
        } elseif ($param1 == 'edit') {
            $page_data['edit_profile'] = $this->db->get_where('paciente', ['numero_id' => $param2])->result_array();
        }

        $page_data['page_name'] = 'gestionar_paciente';
        $page_data['page_title'] = 'Gestionar pacientes';
        $page_data['medicos'] = $this->db->get('paciente')->result_array();
        $page_data['municipios'] = $this->db->get('municipio')->result_array();

        $this->load->view('index', $page_data);

    }

    function desactivar_paciente($numero_id)
    {
        if ($this->session->userdata('admin_login') != 1) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
            } else {
                redirect(base_url() . 'index.php?login', 'refresh');
            }
            return;
        }

        $paciente = $this->db->get_where('paciente', ['numero_id' => $numero_id])->row();

        if (!$paciente) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Paciente no encontrado']);
            } else {
                $this->session->set_flashdata('flash_message', 'Paciente no encontrado.');
                redirect(base_url() . 'index.php?admin/gestionar_paciente', 'refresh');
            }
            return;
        }

        $this->db->where('numero_id', $numero_id);
        $this->db->delete('paciente'); // Se activa el trigger automáticamente

        if ($this->input->is_ajax_request()) {
            echo json_encode(['status' => 'success', 'message' => 'Paciente desactivado correctamente']);
        } else {
            $this->session->set_flashdata('flash_message', 'Paciente desactivado correctamente.');
            redirect(base_url() . 'index.php?admin/gestionar_paciente', 'refresh');
        }
    }

    function ver_paciente_desactivado()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $page_data['page_name'] = 'ver_paciente_desactivado';
        $page_data['page_title'] = 'Pacientes Desactivados';
        $page_data['pacientes'] = $this->db->get('paciente_desactivado')->result_array();
        $this->load->view('index', $page_data);
    }

    function reactivar_paciente($numero_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($numero_id == '') {
            $this->session->set_flashdata('flash_message', 'ID de paciente inválido.');
            redirect(base_url() . 'index.php?admin/ver_paciente_desactivado', 'refresh');
        }

        // Llama al procedimiento almacenado
        $this->db->query("CALL reactivar_paciente(?)", array($numero_id));

        $this->session->set_flashdata('flash_message', 'Paciente reactivado correctamente.');
        redirect(base_url() . 'index.php?admin/gestionar_paciente', 'refresh');
    }


    function gestionar_medico($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            $data['especialidad_id'] = $this->input->post('especialidad_id');
            $data['fecha_nac'] = $this->input->post('fecha_nac');

            $this->db->insert('medico', $data);
            $this->email_model->account_opening_email('medico', $data['correo']);
            $this->session->set_flashdata('flash_message', 'Médico creado correctamente.');
            redirect(base_url() . 'index.php?admin/gestionar_medico', 'refresh');
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
            $data['especialidad_id'] = $this->input->post('especialidad_id');
            $data['fecha_nac'] = $this->input->post('fecha_nac');

            $this->db->where('numero_id', $param3);
            $this->db->update('medico', $data);
            $this->session->set_flashdata('flash_message', 'Datos del médico actualizados correctamente.');
            redirect(base_url() . 'index.php?admin/gestionar_medico', 'refresh');
        } elseif ($param1 == 'edit') {
            $page_data['edit_profile'] = $this->db->get_where('medico', ['numero_id' => $param2])->result_array();
        }

        $page_data['page_name'] = 'gestionar_medico';
        $page_data['page_title'] = 'Gestionar médicos';
        $page_data['medicos'] = $this->db->get('medico')->result_array(); // solo activos
        $this->load->view('index', $page_data);
    }

    function desactivar_medico($numero_id)
    {
        if ($this->session->userdata('admin_login') != 1) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'No autorizado']);
            } else {
                redirect(base_url() . 'index.php?login', 'refresh');
            }
            return;
        }

        $medico = $this->db->get_where('medico', ['numero_id' => $numero_id])->row();

        if (!$medico) {
            if ($this->input->is_ajax_request()) {
                echo json_encode(['status' => 'error', 'message' => 'Médico no encontrado']);
            } else {
                $this->session->set_flashdata('flash_message', 'Médico no encontrado.');
                redirect(base_url() . 'index.php?admin/gestionar_medico', 'refresh');
            }
            return;
        }

        $this->db->where('numero_id', $numero_id);
        $this->db->delete('medico'); // Se activa el trigger automáticamente

        if ($this->input->is_ajax_request()) {
            echo json_encode(['status' => 'success', 'message' => 'Médico desactivado correctamente']);
        } else {
            $this->session->set_flashdata('flash_message', 'Médico desactivado correctamente.');
            redirect(base_url() . 'index.php?admin/gestionar_medico', 'refresh');
        }
    }

    function ver_medico_desactivado()
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $page_data['page_name'] = 'ver_medico_desactivado';
        $page_data['page_title'] = 'Médicos Desactivados';
        $page_data['medicos'] = $this->db->get('medico_desactivado')->result_array();
        $this->load->view('index', $page_data);
    }

    function reactivar_medico($numero_id = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($numero_id == '') {
            $this->session->set_flashdata('flash_message', 'ID de médico inválido.');
            redirect(base_url() . 'index.php?admin/ver_medico_desactivado', 'refresh');
        }

        // Llama al procedimiento almacenado
        $this->db->query("CALL reactivar_medico(?)", array($numero_id));

        $this->session->set_flashdata('flash_message', 'Médico reactivado correctamente.');
        redirect(base_url() . 'index.php?admin/gestionar_medico', 'refresh');
    }



    function ver_cita($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        $page_data['page_name'] = 'ver_cita'; // nombre de la vista
        $page_data['page_title'] = 'Ver cita';
        $page_data['citas'] = $this->db->get('cita')->result_array();
        $this->load->view('index', $page_data);
    }

    function gestionar_tablon_de_anuncios($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param1 == 'create') {
            $data['noticia_titulo'] = $this->input->post('noticia_titulo');
            $data['noticia'] = $this->input->post('noticia');
            $data['crear_timestamp'] = strtotime($this->input->post('crear_timestamp'));
            $this->db->insert('anuncios', $data);
            $this->session->set_flashdata('flash_message', 'Aviso creado exitosamente');
            redirect(base_url() . 'index.php?admin/gestionar_tablon_de_anuncios', 'refresh');
        }

        if ($param1 == 'edit' && $param2 == 'do_update') {
            $data['noticia_titulo'] = $this->input->post('noticia_titulo');
            $data['noticia'] = $this->input->post('noticia');
            $data['crear_timestamp'] = strtotime($this->input->post('crear_timestamp'));
            $this->db->where('noticia_id', $param3);
            $this->db->update('anuncios', $data);
            $this->session->set_flashdata('flash_message', 'Aviso actualizado');
            redirect(base_url() . 'index.php?admin/gestionar_tablon_de_anuncios', 'refresh');
        } elseif ($param1 == 'edit') {
            $page_data['edit_profile'] = $this->db->get_where('anuncios', array(
                'noticia_id' => $param2
            ))->result_array();
        }

        if ($param1 == 'delete') {
            $this->db->where('noticia_id', $param2);
            $this->db->delete('anuncios');
            $this->session->set_flashdata('flash_message', 'Aviso eliminado');
            redirect(base_url() . 'index.php?admin/gestionar_tablon_de_anuncios', 'refresh');
        }

        $page_data['page_name'] = 'gestionar_tablon_de_anuncios';
        $page_data['page_title'] = 'Gestionar el tablón de anuncios';
        $page_data['notices'] = $this->db->get('anuncios')->result_array();
        $this->load->view('index', $page_data);
    }

    public function reporte_citas_medico()
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    $page_data['page_name'] = 'reporte_citas_medico';
    $page_data['page_title'] = 'Reporte de citas atendidas por médico';
    $page_data['medicos'] = $this->db->get('medico')->result_array();
    $page_data['reportes'] = [];

    if ($this->input->post()) {
        $medico_id = $this->input->post('medico_id');
        $mes = $this->input->post('mes');  // Ejemplo: "2025-07"
        $inicio_mes = $mes . '-01';
        $fin_mes = date('Y-m-t', strtotime($inicio_mes)) . ' 23:59:59';

        // 1. Consultar citas atendidas
        $this->db->from('vista_citas_medico_atendidas');
        $this->db->where('medico_id', $medico_id);
        $this->db->where('fecha_hora >=', $inicio_mes);
        $this->db->where('fecha_hora <=', $fin_mes);
        $page_data['reportes'] = $this->db->get()->result_array();

        $page_data['selected_medico'] = $medico_id;
        $page_data['selected_mes'] = $mes;

        // Extraer año y mes numéricos
        $ano = date('Y', strtotime($mes . '-01'));
        $mes_num = date('m', strtotime($mes . '-01'));

        // 2. Registrar que se generó un reporte (sin validar si ya existía)
        $data_reporte = [
            'tipo' => 'medico',
            'mes' => $mes_num,
            'ano' => $ano,
            'parametro_id' => $medico_id,
            'fecha_generacion' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('reporte', $data_reporte);
    }

    $this->load->view('index', $page_data);
}



    public function reporte_citas_paciente()
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    $page_data['page_name'] = 'reporte_citas_paciente';
    $page_data['page_title'] = 'Reporte de citas por paciente';
    $page_data['pacientes'] = $this->db->get('paciente')->result_array();
    $page_data['reportes'] = [];

    if ($this->input->post()) {
    $paciente_id = $this->input->post('paciente_id');
    $mes = $this->input->post('mes');  // Ejemplo: "2025-07"
    $inicio_mes = $mes . '-01';
    $fin_mes = date('Y-m-t', strtotime($inicio_mes)) . ' 23:59:59';

    $this->db->from('vista_citas_paciente');
    $this->db->where('paciente_id', $paciente_id);
    $this->db->where('fecha_hora >=', $inicio_mes);
    $this->db->where('fecha_hora <=', $fin_mes);

    $page_data['reportes'] = $this->db->get()->result_array();

    $page_data['selected_paciente'] = $paciente_id;
    $page_data['selected_mes'] = $mes;

    // Extraer año y mes numéricos
    $ano = date('Y', strtotime($mes . '-01'));
    $mes_num = date('m', strtotime($mes . '-01'));

    // Guardar reporte con mes y año separados
    $data_reporte = [
        'tipo' => 'paciente',
        'mes' => $mes_num,
        'ano' => $ano,
        'parametro_id' => $paciente_id,
        'fecha_generacion' => date('Y-m-d H:i:s')
    ];
    $this->db->insert('reporte', $data_reporte);
}


    $this->load->view('index', $page_data);
}





    public function reporte_citas_ausentes()
{
    if ($this->session->userdata('admin_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    $page_data['page_name'] = 'reporte_citas_ausentes';
    $page_data['page_title'] = 'Relación de las citas no asistidas sin cancelación previa';
    $page_data['reports'] = [];

    if ($this->input->post()) {
        $mes = $this->input->post('mes'); // formato: YYYY-MM
        $inicio_mes = $mes . '-01';
        $fin_mes = date("Y-m-t", strtotime($inicio_mes)) . ' 23:59:59';

        $this->db->from('vista_citas_ausentes');
        $this->db->where('fecha_hora >=', $inicio_mes);
        $this->db->where('fecha_hora <=', $fin_mes);

        $page_data['reports'] = $this->db->get()->result_array();
        $page_data['selected_mes'] = $mes;

        // Extraer año y mes numéricos
        $ano = date('Y', strtotime($mes . '-01'));
        $mes_num = date('m', strtotime($mes . '-01'));

        // Registrar generación del reporte en tabla reporte
        $data_reporte = [
            'tipo' => 'ausentes',
            'mes' => $mes_num,
            'ano' => $ano,
            'parametro_id' => null,  // No hay parámetro específico para ausentes
            'fecha_generacion' => date('Y-m-d H:i:s')
        ];
        $this->db->insert('reporte', $data_reporte);
    }

    $this->load->view('index', $page_data);
}










    function system_settings($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'index.php?login', 'refresh');

        if ($param2 == 'do_update') {
            $this->db->where('type', $param1);
            $this->db->update('settings', array(
                'description' => $this->input->post('description')
            ));
            $this->session->set_flashdata('flash_message', ('Settings Updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        if ($param1 == 'upload_logo') {
            move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
            $this->session->set_flashdata('flash_message', ('Settings Updated'));
            redirect(base_url() . 'index.php?admin/system_settings/', 'refresh');
        }
        $page_data['page_name'] = 'system_settings';
        $page_data['page_title'] = ('Configuración del sistema');
        $page_data['settings'] = $this->db->get('settings')->result_array();
        $this->load->view('index', $page_data);
    }






    // --- SECCIÓN CLAVE PARA EL ERROR ---
    /******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
    function gestionar_perfil($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('admin_login') != 1)
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
            $this->db->update('admin', $data);

            $this->session->set_flashdata('flash_message', 'Perfil actualizado correctamente');
            redirect(base_url() . 'index.php?admin/gestionar_perfil', 'refresh');
        }

        if ($param1 == 'change_password') {
            $password_actual = $this->input->post('password');
            $nuevo_password = $this->input->post('new_password');
            $confirmar_nuevo_password = $this->input->post('confirm_new_password');

            $admin = $this->db->get_where('admin', array(
                'numero_id' => $this->session->userdata('numero_id')
            ))->row();

            if ($admin->contrasena == $password_actual) {
                if ($nuevo_password === $confirmar_nuevo_password) {
                    $this->db->where('numero_id', $admin->numero_id);
                    $this->db->update('admin', array('contrasena' => $nuevo_password));
                    $this->session->set_flashdata('flash_message', 'Contraseña actualizada correctamente');
                } else {
                    $this->session->set_flashdata('flash_message', 'Las nuevas contraseñas no coinciden');
                }
            } else {
                $this->session->set_flashdata('flash_message', 'Contraseña actual incorrecta');
            }

            redirect(base_url() . 'index.php?admin/gestionar_perfil', 'refresh');
        }

        $page_data['page_name'] = 'gestionar_perfil';
        $page_data['page_title'] = 'Gestionar perfil';
        $page_data['edit_profile'] = $this->db->get_where('admin', array(
            'numero_id' => $this->session->userdata('numero_id')
        ))->result_array();

        $this->load->view('index', $page_data);
    }


}