<?php

if (!defined('BASEPATH'))

	exit('No direct script access allowed');



class Login extends CI_Controller

{

	

	

	function __construct()

	{

		parent::__construct();

		$this->load->database();

		/*cash control*/

		$this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');

		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');

		$this->output->set_header('Pragma: no-cache');

		$this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");

		

	}

	

	/***default functin, redirects to login page if no admin logged in yet***/

	public function index()

	{

		if ($this->session->userdata('admin_login') == 1)

			redirect(base_url() . 'index.php?admin/dashboard', 'refresh');

		

		if ($this->session->userdata('medico_login') == 1)

			redirect(base_url() . 'index.php?medico/dashboard', 'refresh');

		

		if ($this->session->userdata('paciente_login') == 1)

			redirect(base_url() . 'index.php?paciente/dashboard', 'refresh');

		

		if ($this->session->userdata('nurse_login') == 1)

			redirect(base_url() . 'index.php?nurse/dashboard', 'refresh');

		

		if ($this->session->userdata('pharmacist_login') == 1)

			redirect(base_url() . 'index.php?pharmacist/dashboard', 'refresh');

		

		if ($this->session->userdata('laboratorist_login') == 1)

			redirect(base_url() . 'index.php?laboratorist/dashboard', 'refresh');

		

		if ($this->session->userdata('accountant_login') == 1)

			redirect(base_url() . 'index.php?accountant/dashboard', 'refresh');

		

		

		

		$config = array(

			array(

				'field' => 'login_type',

				'label' => 'Account Type',

				'rules' => 'required|xss_clean'

			),

			array(

				'field' => 'email',

				'label' => 'Email',

				'rules' => 'required|xss_clean|valid_email'

			),

			array(

				'field' => 'password',

				'label' => 'Password',

				'rules' => 'required|xss_clean|callback__validate_login'

			)

		);

		

		$this->form_validation->set_rules($config);

		$this->form_validation->set_message('_validate_login', ucfirst($this->input->post('login_type')) . ' Login failed!');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error">

								<button type="button" class="close" data-dismiss="alert">×</button>', '</div>');

		

		if ($this->form_validation->run() == FALSE) {

			$this->load->view('login');

		} else {

			if ($this->session->userdata('admin_login') == 1)

				redirect(base_url() . 'index.php?admin/dashboard', 'refresh');

			

			if ($this->session->userdata('medico_login') == 1)

				redirect(base_url() . 'index.php?medico/dashboard', 'refresh');

			

			if ($this->session->userdata('paciente_login') == 1)

				redirect(base_url() . 'index.php?paciente/dashboard', 'refresh');

			

			if ($this->session->userdata('nurse_login') == 1)

				redirect(base_url() . 'index.php?nurse/dashboard', 'refresh');

			

			if ($this->session->userdata('pharmacist_login') == 1)

				redirect(base_url() . 'index.php?pharmacist/dashboard', 'refresh');

			

			if ($this->session->userdata('laboratorist_login') == 1)

				redirect(base_url() . 'index.php?laboratorist/dashboard', 'refresh');

			

			if ($this->session->userdata('accountant_login') == 1)

				redirect(base_url() . 'index.php?accountant/dashboard', 'refresh');

		}

		

	}

	

	/***validate login****/

	function _validate_login($str)
{
    if ($this->input->post('login_type') == '') {
        $this->session->set_flashdata('flash_message', ('Login Failed'));
        return FALSE;
    }

    $login_type = $this->input->post('login_type');

    $this->db->where('correo', $this->input->post('email'));
    $this->db->where('contrasena', $this->input->post('password'));

    $query = $this->db->get($login_type);

    if ($query->num_rows() > 0) {
        $row = $query->row();

        $this->session->set_userdata('login_type', $login_type);
        $this->session->set_userdata($login_type . '_login', '1');

        // Si el login es como médico, usamos numero_id como médico_id
        if ($login_type === 'medico') {
            $this->session->set_userdata('medico_id', $row->numero_id);
        }

        // Puedes usar esto si necesitas el número_id genérico en otras partes
        $this->session->set_userdata('numero_id', $row->numero_id);

        return TRUE;
    } else {
        $this->session->set_flashdata('flash_message', ('Login Failed'));
        return FALSE;
    }
}




	/*******LOGOUT FUNCTION *******/

	function logout()

	{

		$this->session->unset_userdata();

		$this->session->sess_destroy();

		$this->session->set_flashdata('flash_message', ('Logged Out'));

		redirect(base_url() . 'index.php?login', 'refresh');

	}

	

	/***DEFAULT NOR FOUND PAGE*****/

	function four_zero_four()

	{

		$this->load->view('four_zero_four');

	}

	

	/***RESET AND SEND PASSWORD TO REQUESTED EMAIL****/

	function reset_password()

	{

		$account_type = $this->input->post('account_type');

		if ($account_type == "") {

			redirect(base_url(), 'refresh');

		}

		$email  = $this->input->post('email');

		$result = $this->email_model->password_reset_email($account_type, $email); //SEND EMAIL ACCOUNT OPENING EMAIL

		if ($result == true) {

			$this->session->set_flashdata('flash_message', ('Password Sent'));

		} else if ($result == false) {

			$this->session->set_flashdata('flash_message', ('Account Not Found'));

		}

		

		

	}

	

	/***LOGIN AS ANOTHER USER LIKE DOCTOR,PATIENT,PHARMACIST,LABORATORIST ETC******/

	function login_as($user_type = '', $user_id = '')

	{

		$this->session->set_userdata('login_type', $user_type);

		$this->session->set_userdata($user_type . '_login', '1');

		$this->session->set_userdata($user_type . '_id', $user_id);

		redirect(base_url() . 'index.php?' . $user_type . '/dashboard', 'refresh');

	}

	

	

}

