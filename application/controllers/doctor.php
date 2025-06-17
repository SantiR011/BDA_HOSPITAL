<?php

if (!defined('BASEPATH'))

	exit('No direct script access allowed');




class Doctor extends CI_Controller

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

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		if ($this->session->userdata('doctor_login') == 1)

			redirect(base_url() . 'index.php?doctor/dashboard', 'refresh');

	}

	

	/***DOCTOR DASHBOARD***/

	function dashboard()

	{

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

			

		$page_data['page_name']  = 'dashboard';

		$page_data['page_title'] = ('Cuadro de mandos médico');

		$this->load->view('index', $page_data);

	}

	/***Manage pacientes**/

	function manage_paciente($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

			

		if ($param1 == 'create') {

			$data['name']                      = $this->input->post('name');

			$data['email']                     = $this->input->post('email');

			$data['password']                  = $this->input->post('password');

			$data['address']                   = $this->input->post('address');

			$data['phone']                     = $this->input->post('phone');

			$data['sex']                       = $this->input->post('sex');

			$data['birth_date']                = $this->input->post('birth_date');

			$data['age']                       = $this->input->post('age');

			$data['blood_group']               = $this->input->post('blood_group');

			$data['account_opening_timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));

			$this->db->insert('paciente', $data);

			$this->email_model->account_opening_email('paciente', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL

			$this->session->set_flashdata('flash_message', ('Account Opened'));

			

			redirect(base_url() . 'index.php?doctor/manage_paciente', 'refresh');

		}

		if ($param1 == 'edit' && $param2 == 'do_update') {

			$data['name']        = $this->input->post('name');

			$data['email']       = $this->input->post('email');

			$data['password']    = $this->input->post('password');

			$data['address']     = $this->input->post('address');

			$data['phone']       = $this->input->post('phone');

			$data['sex']         = $this->input->post('sex');

			$data['birth_date']  = $this->input->post('birth_date');

			$data['age']         = $this->input->post('age');

			$data['blood_group'] = $this->input->post('blood_group');

			

			$this->db->where('paciente_id', $param3);

			$this->db->update('paciente', $data);

			$this->session->set_flashdata('flash_message', ('Account Updated'));

			redirect(base_url() . 'index.php?doctor/manage_paciente', 'refresh');

			

		} else if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('paciente', array(

				'paciente_id' => $param2

			))->result_array();

		}

		if ($param1 == 'delete') {

			$this->db->where('paciente_id', $param2);

			$this->db->delete('paciente');

			

			$this->session->set_flashdata('flash_message', ('Account Deleted'));

			redirect(base_url() . 'index.php?doctor/manage_paciente', 'refresh');

		}

		$page_data['page_name']  = 'manage_paciente';

		$page_data['page_title'] = ('Gestionar pacientes');

		$page_data['pacientes']   = $this->db->get('paciente')->result_array();

		$this->load->view('index', $page_data);

	}

	

	/***MANAGE APPOINTMENTS******/

	function manage_cita($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		

		if ($param1 == 'create') {

			$data['doctor_id']             = $this->input->post('doctor_id');

			$data['paciente_id']            = $this->input->post('paciente_id');

			$data['cita_timestamp'] = strtotime($this->input->post('cita_timestamp'));

			$this->db->insert('cita', $data);

			$this->session->set_flashdata('flash_message', ('Appointment Created'));

			redirect(base_url() . 'index.php?doctor/manage_cita', 'refresh');

		}

		if ($param1 == 'edit' && $param2 == 'do_update') {

			$data['doctor_id']             = $this->input->post('doctor_id');

			$data['paciente_id']            = $this->input->post('paciente_id');

			$data['cita_timestamp'] = strtotime($this->input->post('cita_timestamp'));

			$this->db->where('cita_id', $param3);

			$this->db->update('cita', $data);

			$this->session->set_flashdata('flash_message', ('Appointment Updated'));

			redirect(base_url() . 'index.php?doctor/manage_cita', 'refresh');

			

		} else if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('cita', array(

				'cita_id' => $param2

			))->result_array();

		}

		if ($param1 == 'delete') {

			$this->db->where('cita_id', $param2);

			$this->db->delete('cita');

			$this->session->set_flashdata('flash_message', ('Appointment Deleted'));

			redirect(base_url() . 'index.php?doctor/manage_cita', 'refresh');

		}

		$page_data['page_name']    = 'manage_cita';

		$page_data['page_title']   = ('Gestionar cita');

		$page_data['citas'] = $this->db->get_where('cita', array(

			'doctor_id' => $this->session->userdata('doctor_id')

		))->result_array();

		$this->load->view('index', $page_data);

	}

	

	/***MANAGE PRESCRIPTIONS******/

	function manage_prescripcion($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

			

		

		if ($param1 == 'create') {

			$data['doctor_id']                  = $this->input->post('doctor_id');

			$data['paciente_id']                 = $this->input->post('paciente_id');

			$data['creation_timestamp']         = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));

			$data['case_history']               = $this->input->post('case_history');

			$data['medication']                 = $this->input->post('medication');

			$data['medication_from_pharmacist'] = $this->input->post('medication_from_pharmacist');

			$data['description']                = $this->input->post('description');

			

			$this->db->insert('prescripcion', $data);

			$this->session->set_flashdata('flash_message', ('Prescription Created'));

			

			redirect(base_url() . 'index.php?doctor/manage_prescripcion', 'refresh');

		}

		if ($param1 == 'edit' && $param2 == 'do_update') {

			$data['doctor_id']                  = $this->input->post('doctor_id');

			$data['paciente_id']                 = $this->input->post('paciente_id');

			$data['case_history']               = $this->input->post('case_history');

			$data['medication']                 = $this->input->post('medication');

			$data['medication_from_pharmacist'] = $this->input->post('medication_from_pharmacist');

			$data['description']                = $this->input->post('description');

			

			$this->db->where('prescripcion_id', $param3);

			$this->db->update('prescripcion', $data);

			$this->session->set_flashdata('flash_message', ('Prescription Updated'));

			redirect(base_url() . 'index.php?doctor/manage_prescripcion', 'refresh');

		} else if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('prescripcion', array(

				'prescripcion_id' => $param2

			))->result_array();

		}

		if ($param1 == 'delete') {

			$this->db->where('prescripcion_id', $param2);

			$this->db->delete('prescripcion');

			$this->session->set_flashdata('flash_message', ('Prescription Deleted'));

			

			redirect(base_url() . 'index.php?doctor/manage_prescripcion', 'refresh');

		}

		$page_data['page_name']     = 'manage_prescripcion';

		$page_data['page_title']    = ('Gestionar la prescripción');

		$page_data['prescripcions'] = $this->db->get('prescripcion')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/*******VIEW BLOOD BANK	********/

	function view_blood_bank($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('doctor_login') != 1)

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

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		

		//create a new allotment only in available / unalloted beds. beds can be ward,cabin,icu,other types

		if ($param1 == 'create') {

			$data['bed_id']              = $this->input->post('bed_id');

			$data['paciente_id']          = $this->input->post('paciente_id');

			$data['allotment_timestamp'] = $this->input->post('allotment_timestamp');

			$data['discharge_timestamp'] = $this->input->post('discharge_timestamp');

			$this->db->insert('bed_allotment', $data);

			$this->session->set_flashdata('flash_message', ('Bed Alloted'));

			redirect(base_url() . 'index.php?doctor/manage_bed_allotment', 'refresh');

		}

		if ($param1 == 'edit' && $param2 == 'do_update') {

			$data['bed_id']              = $this->input->post('bed_id');

			$data['paciente_id']          = $this->input->post('paciente_id');

			$data['allotment_timestamp'] = $this->input->post('allotment_timestamp');

			$data['discharge_timestamp'] = $this->input->post('discharge_timestamp');

			$this->db->where('bed_allotment_id', $param3);

			$this->db->update('bed_allotment', $data);

			$this->session->set_flashdata('flash_message', ('Bed Allotment Updated'));

			redirect(base_url() . 'index.php?doctor/manage_bed_allotment', 'refresh');

			

		} else if ($param1 == 'edit') {

			$page_data['edit_profile'] = $this->db->get_where('bed_allotment', array(

				'bed_allotment_id' => $param2

			))->result_array();

		}

		if ($param1 == 'delete') {

			$this->db->where('bed_allotment_id', $param2);

			$this->db->delete('bed_allotment');

			$this->session->set_flashdata('flash_message', ('Bed Allotment Deleted'));

			redirect(base_url() . 'index.php?doctor/manage_bed_allotment', 'refresh');

		}

		$page_data['page_name']     = 'manage_bed_allotment';

		$page_data['page_title']    = ('Gestionar la asignación de camas');

		$page_data['bed_allotment'] = $this->db->get('bed_allotment')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/***CREATE REPORT BIRTH,DEATH,OPERATION**/

	function manage_reporte($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		

		//create a new reporte baby birth,paciente death, operation , other types

		if ($param1 == 'create') {

			$data['type']        = $this->input->post('type');

			$data['description'] = $this->input->post('description');

			$data['timestamp']   = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));

			$data['doctor_id']   = $this->input->post('doctor_id');

			$data['paciente_id']  = $this->input->post('paciente_id');

			$this->db->insert('reporte', $data);

			$this->session->set_flashdata('flash_message', ('Report Created'));

			redirect(base_url() . 'index.php?doctor/manage_reporte', 'refresh');

		}

		if ($param1 == 'delete') {

			$this->db->where('reporte_id', $param2);

			$this->db->delete('reporte');

			$this->session->set_flashdata('flash_message', ('Report Deleted'));

			redirect(base_url() . 'index.php?doctor/manage_reporte', 'refresh');

		}

		$page_data['page_name']  = 'manage_reporte';

		$page_data['page_title'] = ('Gestionar informe');

		$page_data['reportes']    = $this->db->get('reporte')->result_array();

		$this->load->view('index', $page_data);

	}

	

	

	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/

	function manage_profile($param1 = '', $param2 = '', $param3 = '')

	{

		if ($this->session->userdata('doctor_login') != 1)

			redirect(base_url() . 'index.php?login', 'refresh');

		if ($param1 == 'update_profile_info') {

			$data['name']    = $this->input->post('name');

			$data['email']   = $this->input->post('email');

			$data['address'] = $this->input->post('address');

			$data['phone']   = $this->input->post('phone');

			$data['profile'] = $this->input->post('profile');

			

			$this->db->where('doctor_id', $this->session->userdata('doctor_id'));

			$this->db->update('doctor', $data);

			$this->session->set_flashdata('flash_message', ('Profile Updated'));

			redirect(base_url() . base_url() . 'index.php?doctor/manage_profile/', 'refresh');

		}

		if ($param1 == 'change_password') {

			$data['password']             = $this->input->post('password');

			$data['new_password']         = $this->input->post('new_password');

			$data['confirm_new_password'] = $this->input->post('confirm_new_password');

			

			$current_password = $this->db->get_where('doctor', array(

				'doctor_id' => $this->session->userdata('doctor_id')

			))->row()->password;

			if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {

				$this->db->where('doctor_id', $this->session->userdata('doctor_id'));

				$this->db->update('doctor', array(

					'password' => $data['new_password']

				));

				$this->session->set_flashdata('flash_message', ('Password Updated'));

			} else {

				$this->session->set_flashdata('flash_message', ('Password Mismatch'));

			}

			redirect(base_url() . base_url() . 'index.php?doctor/manage_profile/', 'refresh');

		}

		$page_data['page_name']    = 'manage_profile';

		$page_data['page_title']   = ('Gestionar perfil');

		$page_data['edit_profile'] = $this->db->get_where('doctor', array(

			'doctor_id' => $this->session->userdata('doctor_id')

		))->result_array();

		$this->load->view('index', $page_data);

	}

}