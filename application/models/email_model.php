<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function account_opening_email($account_type = '', $email = '') {
        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;

        $user = $this->db->get_where($account_type, array('correo' => $email))->row();

        if (!$user) return; // Verifica que el usuario exista

        $email_msg  = "Bienvenido(a) a " . $system_name . "<br />";
        $email_msg .= "Tipo de cuenta: " . $account_type . "<br />";
        $email_msg .= "Contraseña de ingreso: " . $user->contrasena . "<br />";
        $email_msg .= "Ingrese aquí: " . base_url() . "<br />";

        $email_sub  = "Cuenta creada en " . $system_name;
        $email_to   = $email;

        $this->do_email($email_msg, $email_sub, $email_to);
    }

    function password_reset_email($account_type = '', $email = '') {
        $query = $this->db->get_where($account_type, array('correo' => $email));
        if ($query->num_rows() > 0) {
            $password = $query->row()->contrasena;

            $email_msg  = "Tipo de cuenta: " . $account_type . "<br />";
            $email_msg .= "Su contraseña es: " . $password . "<br />";

            $email_sub  = "Solicitud de recuperación de contraseña";
            $email_to   = $email;

            $this->do_email($email_msg, $email_sub, $email_to);
            return true;
        } else {
            return false;
        }
    }

    /*** Envío de correo personalizado ***/
    function do_email($msg = NULL, $sub = NULL, $to = NULL, $from = NULL) {
        $config = array();
        $config['useragent']    = "CodeIgniter";
        $config['mailpath']     = "/usr/bin/sendmail";
        $config['protocol']     = "smtp";
        $config['smtp_host']    = "localhost";
        $config['smtp_port']    = "25";
        $config['mailtype']     = 'html';
        $config['charset']      = 'utf-8';
        $config['newline']      = "\r\n";
        $config['wordwrap']     = TRUE;

        $this->load->library('email');
        $this->email->initialize($config);

        $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;

        if ($from == NULL)
            $from = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;

        $this->email->from($from, $system_name);
        $this->email->to($to);
        $this->email->subject($sub);

        $msg .= "<br /><br /><br /><br /><br /><br /><br /><hr /><center>
        <a href=\"http://codecanyon.net/item/bayanno-hospital-management-system-pro/5814621?ref=joyontaroy\">
        &copy; 2013 Bayanno Hospital Management System</a></center>";

        $this->email->message($msg);
        $this->email->send();

        // Puedes habilitar esta línea para depurar:
        // echo $this->email->print_debugger();
    }
}
