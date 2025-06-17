<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/*	
 *	Hospital Management system
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
		$page_data['page_name']  = 'dashboard';
		$page_data['page_title'] = ('Panel de administración');
		$this->load->view('index', $page_data);
	}
	
	/***DEPARTMENTS OF DOCTORS********/
	function manage_especialidad($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->insert('especialidad', $data);
			$this->session->set_flashdata('flash_message', ('Department Opened'));
			redirect(base_url() . 'index.php?admin/manage_especialidad', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']        = $this->input->post('name');
			$data['description'] = $this->input->post('description');
			$this->db->where('especialidad_id', $param3);
			$this->db->update('especialidad', $data);
			$this->session->set_flashdata('flash_message', ('Department Updated'));
			redirect(base_url() . 'index.php?admin/manage_especialidad', 'refresh');
			
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('especialidad', array(
				'especialidad_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('especialidad_id', $param2);
			$this->db->delete('especialidad');
			$this->session->set_flashdata('flash_message', ('Department Deleted'));
			redirect(base_url() . 'index.php?admin/manage_especialidad', 'refresh');
		}
		$page_data['page_name']   = 'manage_especialidad';
		$page_data['page_title']  = ('Gestionar departamento');
		$page_data['especialidads'] = $this->db->get('especialidad')->result_array();
		$this->load->view('index', $page_data);
		
	}
	/***Manage doctors**/
	function manage_doctor($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']          = $this->input->post('name');
			$data['email']         = $this->input->post('email');
			$data['password']      = $this->input->post('password');
			$data['address']       = $this->input->post('address');
			$data['phone']         = $this->input->post('phone');
			$data['especialidad_id'] = $this->input->post('especialidad_id');
			$data['profile']       = $this->input->post('profile');
			$this->db->insert('doctor', $data);
			$this->email_model->account_opening_email('doctor', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', ('Account Opened'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']          = $this->input->post('name');
			$data['email']         = $this->input->post('email');
			$data['password']      = $this->input->post('password');
			$data['address']       = $this->input->post('address');
			$data['phone']         = $this->input->post('phone');
			$data['especialidad_id'] = $this->input->post('especialidad_id');
			$data['profile']       = $this->input->post('profile');
			
			$this->db->where('doctor_id', $param3);
			$this->db->update('doctor', $data);
			$this->session->set_flashdata('flash_message', ('Account Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('doctor', array(
				'doctor_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('doctor_id', $param2);
			$this->db->delete('doctor');
			$this->session->set_flashdata('flash_message', ('Account Deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_doctor', 'refresh');
		}
		$page_data['page_name']  = 'manage_doctor';
		$page_data['page_title'] = ('Gestionar médico');
		$page_data['doctors']    = $this->db->get('doctor')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage pacientes**/
	function manage_paciente($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
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
			
			redirect(base_url() . 'index.php?admin/manage_paciente', 'refresh');
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
			
			redirect(base_url() . 'index.php?admin/manage_paciente', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('paciente', array(
				'paciente_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('paciente_id', $param2);
			$this->db->delete('paciente');
			$this->session->set_flashdata('flash_message', ('Account Deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_paciente', 'refresh');
		}
		$page_data['page_name']  = 'manage_paciente';
		$page_data['page_title'] = ('Gestionar pacientes');
		$page_data['pacientes']   = $this->db->get('paciente')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	/***Manage medicos**/
	function manage_medico($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('medico', $data);
			$this->email_model->account_opening_email('medico', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', ('Account Opened'));
			
			redirect(base_url() . 'index.php?admin/manage_medico', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('medico_id', $param3);
			$this->db->update('medico', $data);
			$this->session->set_flashdata('flash_message', ('Account Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_medico', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('medico', array(
				'medico_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('medico_id', $param2);
			$this->db->delete('medico');
			$this->session->set_flashdata('flash_message', ('Account Deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_medico', 'refresh');
		}
		$page_data['page_name']  = 'manage_medico';
		$page_data['page_title'] = ('Gestionar enfermera');
		$page_data['medicos']     = $this->db->get('medico')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage pharmacists**/
	function manage_pharmacist($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('pharmacist', $data);
			$this->email_model->account_opening_email('pharmacist', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', ('Account Opened'));
			redirect(base_url() . 'index.php?admin/manage_pharmacist', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('pharmacist_id', $param3);
			$this->db->update('pharmacist', $data);
			$this->session->set_flashdata('flash_message', ('Account Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_pharmacist', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('pharmacist', array(
				'pharmacist_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('pharmacist_id', $param2);
			$this->db->delete('pharmacist');
			$this->session->set_flashdata('flash_message', ('Account Deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_pharmacist', 'refresh');
		}
		$page_data['page_name']   = 'manage_pharmacist';
		$page_data['page_title']  = ('Gestionar farmacéutico');
		$page_data['pharmacists'] = $this->db->get('pharmacist')->result_array();
		$this->load->view('index', $page_data);
		
	}
	
	/***Manage laboratorists**/
	function manage_laboratorist($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('laboratorist', $data);
			$this->email_model->account_opening_email('laboratorist', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', ('Account Opened'));
			redirect(base_url() . 'index.php?admin/manage_laboratorist', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('laboratorist_id', $param3);
			$this->db->update('laboratorist', $data);
			$this->session->set_flashdata('flash_message', ('Account Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_laboratorist', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('laboratorist', array(
				'laboratorist_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('laboratorist_id', $param2);
			$this->db->delete('laboratorist');
			$this->session->set_flashdata('flash_message', ('Account Deleted'));
			redirect(base_url() . 'index.php?admin/manage_laboratorist', 'refresh');
		}
		$page_data['page_name']     = 'manage_laboratorist';
		$page_data['page_title']    = ('Gestionar Laboratorista');
		$page_data['laboratorists'] = $this->db->get('laboratorist')->result_array();
		$this->load->view('index', $page_data);
	}
	/***Manage accountants**/
	function manage_accountant($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'create') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->insert('accountant', $data);
			$this->email_model->account_opening_email('accountant', $data['email']); //SEND EMAIL ACCOUNT OPENING EMAIL
			$this->session->set_flashdata('flash_message', ('Account Opened'));
			
			redirect(base_url() . 'index.php?admin/manage_accountant', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['name']     = $this->input->post('name');
			$data['email']    = $this->input->post('email');
			$data['password'] = $this->input->post('password');
			$data['address']  = $this->input->post('address');
			$data['phone']    = $this->input->post('phone');
			$this->db->where('accountant_id', $param3);
			$this->db->update('accountant', $data);
			$this->session->set_flashdata('flash_message', ('Account Updated'));
			redirect(base_url() . 'index.php?admin/manage_accountant', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('accountant', array(
				'accountant_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('accountant_id', $param2);
			$this->db->delete('accountant');
			$this->session->set_flashdata('flash_message', ('Account Deleted'));
			redirect(base_url() . 'index.php?admin/manage_accountant', 'refresh');
		}
		$page_data['page_name']   = 'manage_accountant';
		$page_data['page_title']  = ('Gestionar contable');
		$page_data['accountants'] = $this->db->get('accountant')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW APPOINTMENT REPORT	********/
	function view_cita($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']    = 'view_cita';
		$page_data['page_title']   = ('Ver cita');
		$page_data['citas'] = $this->db->get('cita')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW PAYMENT REPORT	********/
	function view_payment($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']  = 'view_payment';
		$page_data['page_title'] = ('Ver pago');
		$page_data['payments']   = $this->db->get('payment')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW BED STATUS	********/
	function view_bed_status($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']      = 'view_bed_status';
		$page_data['page_title']     = ('Ver Banco de Sangre');
		$page_data['bed_allotments'] = $this->db->get('bed_allotment')->result_array();
		$page_data['beds']           = $this->db->get('bed')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW BLOOD BANK	********/
	function view_blood_bank($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']    = 'view_blood_bank';
		$page_data['page_title']   = ('Ver Banco de Sangre');
		$page_data['blood_donors'] = $this->db->get('blood_donor')->result_array();
		$page_data['blood_bank']   = $this->db->get('blood_bank')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW MEDICINE********/
	function view_medicamento($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']  = 'view_medicamento';
		$page_data['page_title'] = ('Ver Medicina');
		$page_data['medicamentos']  = $this->db->get('medicamento')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*******VIEW MEDICINE********/
	function view_reporte($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		$page_data['page_name']   = 'view_reporte';
		$page_data['page_title']  = ('Ver ' . $param1 . ' Reporte');
		$page_data['reporte_type'] = $param1;
		$page_data['reportes']     = $this->db->get_where('reporte', array(
			'type' => $param1
		))->result_array();
		$this->load->view('index', $page_data);
	}
	
	/***MANAGE EMAIL TEMPLATE**/
	function manage_email_template($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param2 == 'do_update') {
			$this->db->where('task', $param1);
			$this->db->update('email_template', array(
				'body' => $this->input->post('body'),
				'subject' => $this->input->post('subject')
			));
			$this->session->set_flashdata('flash_message', ('Template Updated'));
			redirect(base_url() . 'index.php?admin/manage_email_template/' . $param1, 'refresh');
		}
		$page_data['page_name']     = 'manage_email_template';
		$page_data['page_title']    = ('Gestionar plantilla de correo electrónico');
		$page_data['template']      = $this->db->get_where('email_template', array(
			'task' => $param1
		))->result_array();
		$page_data['template_task'] = $param1;
		$this->load->view('index', $page_data);
	}
	
	/***MANAGE NOTICEBOARD, WILL BE SEEN BY ALL ACCOUNTS DASHBOARD**/
	function manage_anuncios($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'create') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->insert('anuncios', $data);
			$this->session->set_flashdata('flash_message', ('Report Created'));
			
			redirect(base_url() . 'index.php?admin/manage_anuncios', 'refresh');
		}
		if ($param1 == 'edit' && $param2 == 'do_update') {
			$data['notice_title']     = $this->input->post('notice_title');
			$data['notice']           = $this->input->post('notice');
			$data['create_timestamp'] = strtotime($this->input->post('create_timestamp'));
			$this->db->where('notice_id', $param3);
			$this->db->update('anuncios', $data);
			$this->session->set_flashdata('flash_message', ('Notice Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_anuncios', 'refresh');
		} else if ($param1 == 'edit') {
			$page_data['edit_profile'] = $this->db->get_where('anuncios', array(
				'notice_id' => $param2
			))->result_array();
		}
		if ($param1 == 'delete') {
			$this->db->where('notice_id', $param2);
			$this->db->delete('anuncios');
			$this->session->set_flashdata('flash_message', ('Notice Deleted'));
			
			redirect(base_url() . 'index.php?admin/manage_anuncios', 'refresh');
		}
		$page_data['page_name']  = 'manage_anuncios';
		$page_data['page_title'] = ('Gestionar el tablón de anuncios');
		$page_data['notices']    = $this->db->get('anuncios')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	/*****SITE/SYSTEM SETTINGS*********/
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
		$page_data['page_name']  = 'system_settings';
		$page_data['page_title'] = ('Configuración del sistema');
		$page_data['settings']   = $this->db->get('settings')->result_array();
		$this->load->view('index', $page_data);
	}
	
	/*****LANGUAGE SETTINGS*********/
	function manage_language($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
		
		if ($param1 == 'edit_phrase') {
			$page_data['edit_profile'] 	= $param2;	
		}
		if ($param1 == 'update_phrase') {
			$language	=	$param2;
			$total_phrase	=	$this->input->post('total_phrase');
			for($i = 1 ; $i < $total_phrase ; $i++)
			{
				//$data[$language]	=	$this->input->post('phrase').$i;
				$this->db->where('phrase_id' , $i);
				$this->db->update('language' , array($language => $this->input->post('phrase'.$i)));
			}
			redirect(base_url() . 'index.php?admin/manage_language/edit_phrase/'.$language, 'refresh');
		}
		if ($param1 == 'do_update') {
			$language        = $this->input->post('language');
			$data[$language] = $this->input->post('phrase');
			$this->db->where('phrase_id', $param2);
			$this->db->update('language', $data);
			$this->session->set_flashdata('flash_message', ('Settings Updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_phrase') {
			$data['phrase'] = $this->input->post('phrase');
			$this->db->insert('language', $data);
			$this->session->set_flashdata('flash_message', ('Settings Updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'add_language') {
			$language = $this->input->post('language');
			$this->load->dbforge();
			$fields = array(
				$language => array(
					'type' => 'LONGTEXT'
				)
			);
			$this->dbforge->add_column('language', $fields);
			
			$this->session->set_flashdata('flash_message', ('Settings Updated'));
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		if ($param1 == 'delete_language') {
			$language = $param2;
			$this->load->dbforge();
			$this->dbforge->drop_column('language', $language);
			$this->session->set_flashdata('flash_message', ('Settings Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_language/', 'refresh');
		}
		$page_data['page_name']        = 'manage_language';
		$page_data['page_title']       = ('Gestionar la lengua');
		//$page_data['language_phrases'] = $this->db->get('language')->result_array();
		$this->load->view('index', $page_data);
	}
	
	
	/*****BACKUP / RESTORE / DELETE DATA PAGE**********/
	function backup_restore($operation = '', $type = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect('login', 'refresh');
		
		if ($operation == 'create') {
			$this->crud_model->create_backup($type);
		}
		if ($operation == 'restore') {
			$this->crud_model->restore_backup();
			redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
		}
		if ($operation == 'delete') {
			$this->crud_model->truncate($type);
			redirect(base_url() . 'index.php?admin/backup_restore/', 'refresh');
		}
		
		$page_data['page_name']  = 'backup_restore';
		$page_data['page_title'] = ('Restaurar copia de seguridad');
		$this->load->view('index', $page_data);
	}
	
	/******MANAGE OWN PROFILE AND CHANGE PASSWORD***/
	function manage_profile($param1 = '', $param2 = '', $param3 = '')
	{
		if ($this->session->userdata('admin_login') != 1)
			redirect(base_url() . 'index.php?login', 'refresh');
			
		if ($param1 == 'update_profile_info') {
			$data['name']    = $this->input->post('name');
			$data['email']   = $this->input->post('email');
			$data['address'] = $this->input->post('address');
			$data['phone']   = $this->input->post('phone');
			
			$this->db->where('admin_id', $this->session->userdata('admin_id'));
			$this->db->update('admin', $data);
			$this->session->set_flashdata('flash_message', ('Account Updated'));
			
			redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
		}
		if ($param1 == 'change_password') {
			$data['password']             = $this->input->post('password');
			$data['new_password']         = $this->input->post('new_password');
			$data['confirm_new_password'] = $this->input->post('confirm_new_password');
			
			$current_password = $this->db->get_where('admin', array(
				'admin_id' => $this->session->userdata('admin_id')
			))->row()->password;
			if ($current_password == $data['password'] && $data['new_password'] == $data['confirm_new_password']) {
				$this->db->where('admin_id', $this->session->userdata('admin_id'));
				$this->db->update('admin', array(
					'password' => $data['new_password']
				));
				$this->session->set_flashdata('flash_message', ('Password Updated'));
			} else {
				$this->session->set_flashdata('flash_message', ('Password Mismatch'));
			}
			
			redirect(base_url() . 'index.php?admin/manage_profile/', 'refresh');
		}
		$page_data['page_name']    = 'manage_profile';
		$page_data['page_title']   = ('Gestionar perfil');
		$page_data['edit_profile'] = $this->db->get_where('admin', array(
			'admin_id' => $this->session->userdata('admin_id')
		))->result_array();
		$this->load->view('index', $page_data);
	}
	
}
