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

			

		$page_data['page_name']  = 'dashboard';

		$page_data['page_title'] = ('Cuadro de mandos médico');

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

	function gestionar_cita($param1 = '', $param2 = '', $param3 = '')
{
    // Validar sesión de médico
    if ($this->session->userdata('medico_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    $numero_id = $this->session->userdata('numero_id'); // médico autenticado

    if ($param1 == 'create') {
        $data['numero_id'] = $numero_id;
        $data['numero_id'] = $this->input->post('numero_id');
        $data['especialidad_id'] = $this->input->post('especialidad_id');
        $data['lugar_id'] = $this->input->post('lugar_id');

        // Validar que el estado exista y no sea 0
        $estado_id = $this->input->post('estado_id');
        if ($estado_id && $estado_id > 0) {
            $data['estado_id'] = $estado_id;
        } else {
            $data['estado_id'] = 1; // estado por defecto: "Pendiente"
        }

        $data['fecha_hora'] = $this->input->post('fecha_hora');
        $data['fecha_registro'] = date('Y-m-d H:i:s');
        $data['fecha_actualizacion'] = date('Y-m-d H:i:s');

        $this->db->insert('cita', $data);
        $this->session->set_flashdata('flash_message', 'Cita creada correctamente');
        redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
    }

    if ($param1 == 'edit' && $param2 == 'do_update') {
        $data['numero_id'] = $numero_id;
        $data['numero_id'] = $this->input->post('numero_id');
        $data['especialidad_id'] = $this->input->post('especialidad_id');
        $data['lugar_id'] = $this->input->post('lugar_id');

        $estado_id = $this->input->post('estado_id');
        $data['estado_id'] = ($estado_id && $estado_id > 0) ? $estado_id : 1;

        $data['fecha_hora'] = $this->input->post('fecha_hora');
        $data['fecha_actualizacion'] = date('Y-m-d H:i:s');

        $this->db->where('cita_id', $param3);
        $this->db->update('cita', $data);
        $this->session->set_flashdata('flash_message', 'Cita actualizada correctamente');
        redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
    } else if ($param1 == 'edit') {
        $page_data['edit_profile'] = $this->db->get_where('cita', array(
            'cita_id' => $param2,
            'numero_id' => $numero_id
        ))->result_array();
    }

    if ($param1 == 'delete') {
        // Solo puede eliminar su propia cita
        $this->db->where('cita_id', $param2);
        $this->db->where('numero_id', $numero_id);
        $this->db->delete('cita');
        $this->session->set_flashdata('flash_message', 'Cita eliminada correctamente');
        redirect(base_url() . 'index.php?medico/gestionar_cita', 'refresh');
    }

    // Preparar datos para la vista
    $page_data['page_name'] = 'gestionar_cita';
    $page_data['page_title'] = 'Gestionar cita';
    $page_data['citas'] = $this->db->get_where('cita', array('numero_id' => $numero_id))->result_array();

    $page_data['pacientes'] = $this->db->get('paciente')->result_array();
    $page_data['lugares'] = $this->db->get('lugar')->result_array();
    $page_data['especialidades'] = $this->db->get('especialidad')->result_array();
    $page_data['estados'] = $this->db->get('estado_cita')->result_array();

    $this->load->view('index', $page_data);
}


	

	/***MANAGE PRESCRIPTIONS******/

	function manage_prescripcion($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('medico_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

			

		

		if ($param1 == 'create') {

			$data['numero_id']                  = $this->input->post('numero_id');

			$data['numero_id']                 = $this->input->post('numero_id');

			$data['creation_timestamp']         = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));

			$data['case_history']               = $this->input->post('case_history');

			$data['medication']                 = $this->input->post('medication');

			$data['medication_from_pharmacist'] = $this->input->post('medication_from_pharmacist');

			$data['description']                = $this->input->post('description');

			

			$this->db->insert('prescripcion', $data);

			$this->session->set_flashdata('flash_message', ('Prescription Created'));

			

			redirect(base_url() . 'index.php?medico/manage_prescripcion', 'refresh');

		}

		if ($param1 == 'edit' && $param2 == 'do_update') {

			$data['numero_id']                  = $this->input->post('numero_id');

			$data['numero_id']                 = $this->input->post('numero_id');

			$data['case_history']               = $this->input->post('case_history');

			$data['medication']                 = $this->input->post('medication');

			$data['medication_from_pharmacist'] = $this->input->post('medication_from_pharmacist');

			$data['description']                = $this->input->post('description');

			

			$this->db->where('prescripcion_id', $param3);

			$this->db->update('prescripcion', $data);

			$this->session->set_flashdata('flash_message', ('Prescription Updated'));

			redirect(base_url() . 'index.php?medico/manage_prescripcion', 'refresh');

		} else if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('prescripcion', array(

				'prescripcion_id' => $param2

			))->result_array();

		}

		if ($param1 == 'delete') {

			$this->db->where('prescripcion_id', $param2);

			$this->db->delete('prescripcion');

			$this->session->set_flashdata('flash_message', ('Prescription Deleted'));

			

			redirect(base_url() . 'index.php?medico/manage_prescripcion', 'refresh');

		}

		$page_data['page_name']     = 'manage_prescripcion';

		$page_data['page_title']    = ('Gestionar la prescripción');

		$page_data['prescripcions'] = $this->db->get('prescripcion')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/*******VIEW BLOOD BANK	********/

	function view_blood_bank($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('medico_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

			

		$page_data['page_name']    = 'view_blood_bank';

		$page_data['page_title']   = ('Ver Banco de Sangre');

		$page_data['blood_donors'] = $this->db->get('blood_donor')->result_array();

		$page_data['blood_bank']   = $this->db->get('blood_bank')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/******ALLOT / DISCHARGE BED TO PATIENTS*****/

	function manage_bed_allotment($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('medico_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		

		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types

		if ($param1 == 'create') {

			$data['bed_id']              = $this->input->post('bed_id');

			$data['numero_id']          = $this->input->post('numero_id');

			$data['allotment_timestamp'] = $this->input->post('allotment_timestamp');

			$data['discharge_timestamp'] = $this->input->post('discharge_timestamp');

			$this->db->insert('bed_allotment', $data);

			$this->session->set_flashdata('flash_message', ('Bed Alloted'));

			redirect(base_url() . 'index.php?medico/manage_bed_allotment', 'refresh');

		}

		if ($param1 == 'edit' && $param2 == 'do_update') {

			$data['bed_id']              = $this->input->post('bed_id');

			$data['numero_id']          = $this->input->post('numero_id');

			$data['allotment_timestamp'] = $this->input->post('allotment_timestamp');

			$data['discharge_timestamp'] = $this->input->post('discharge_timestamp');

			$this->db->where('bed_allotment_id', $param3);

			$this->db->update('bed_allotment', $data);

			$this->session->set_flashdata('flash_message', ('Bed Allotment Updated'));

			redirect(base_url() . 'index.php?medico/manage_bed_allotment', 'refresh');

			

		} else if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('bed_allotment', array(

				'bed_allotment_id' => $param2

			))->result_array();

		}

		if ($param1 == 'delete') {

			$this->db->where('bed_allotment_id', $param2);

			$this->db->delete('bed_allotment');

			$this->session->set_flashdata('flash_message', ('Bed Allotment Deleted'));

			redirect(base_url() . 'index.php?medico/manage_bed_allotment', 'refresh');

		}

		$page_data['page_name']     = 'manage_bed_allotment';

		$page_data['page_title']    = ('Gestionar la asignación de camas');

		$page_data['bed_allotment'] = $this->db->get('bed_allotment')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/***CREATE REPORT BIRTH,DEATH,OPERATION**/

	function manage_reporte($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('medico_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		

		//create a new reporte baby birth,paciente death, operation , other types

		if ($param1 == 'create') {

			$data['type']        = $this->input->post('type');

			$data['description'] = $this->input->post('description');

			$data['timestamp']   = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));

			$data['numero_id']   = $this->input->post('numero_id');

			$data['numero_id']  = $this->input->post('numero_id');

			$this->db->insert('reporte', $data);

			$this->session->set_flashdata('flash_message', ('Report Created'));

			redirect(base_url() . 'index.php?medico/manage_reporte', 'refresh');

		}

		if ($param1 == 'delete') {

			$this->db->where('reporte_id', $param2);

			$this->db->delete('reporte');

			$this->session->set_flashdata('flash_message', ('Report Deleted'));

			redirect(base_url() . 'index.php?medico/manage_reporte', 'refresh');

		}

		$page_data['page_name']  = 'manage_reporte';

		$page_data['page_title'] = ('Gestionar informe');

		$page_data['reportes']    = $this->db->get('reporte')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/

	function gestionar_perfil($param1 = '', $param2 = '', $param3 = '')
{
    if ($this->session->userdata('medico_login') != 1)
        redirect(base_url() . 'index.php?login', 'refresh');

    if ($param1 == 'update_profile_info') {
        $data['tipo_id']     = $this->input->post('tipo_id');
        $data['numero_id']   = $this->input->post('numero_id');
        $data['nombres']     = $this->input->post('nombres');
        $data['apellidos']   = $this->input->post('apellidos');
        $data['correo']      = $this->input->post('correo');
        $data['direccion']   = $this->input->post('direccion');
        $data['municipio_id'] = $this->input->post('municipio_id');
        $data['telefono_principal'] = $this->input->post('telefono_principal');
        $data['fecha_nac']   = $this->input->post('fecha_nac');

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

    $page_data['page_name']   = 'gestionar_perfil';
    $page_data['page_title']  = 'Gestionar perfil';
    $page_data['edit_profile'] = $this->db->get_where('medico', array(
        'numero_id' => $this->session->userdata('numero_id')
    ))->result_array();

    $this->load->view('index', $page_data);
}


}