<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    /**
     * Obtiene un campo específico (por defecto 'name') de una tabla por ID de forma segura.
     */
    function get_type_name_by_id($type, $type_id = '', $field = 'name') 
    {
        // Tablas que usan 'numero_id' en lugar de '[tabla]_id'
        $tablas_con_numero_id = ['admin', 'paciente', 'medico'];
        
        $column = in_array($type, $tablas_con_numero_id) ? 'numero_id' : $type . '_id';
        
        $row = $this->db->get_where($type, array($column => $type_id))->row();
        return $row ? $row->$field : '';
    }

    public function obtener_nombre_estado_cita($estado_id)
    {
        $query = $this->db->get_where('estado_cita', ['estado_id' => $estado_id]);
        $estado = $query->row();

        return $estado ? $estado->nombre : '';
    }

    /**
     * Devuelve el nombre completo por ID (nombres + apellidos) de una tabla como 'paciente' o 'medico'.
     */
    function get_full_name_by_id($type, $type_id) 
    {
        // Tablas que usan 'numero_id' en lugar de '[tabla]_id'
        $tablas_con_numero_id = ['admin', 'paciente', 'medico'];
        
        $column = in_array($type, $tablas_con_numero_id) ? 'numero_id' : $type . '_id';
        
        $row = $this->db->get_where($type, array($column => $type_id))->row();
        return $row ? ($row->nombres . ' ' . $row->apellidos) : '';
    }

    /**
     * Guarda un registro en la tabla de logs.
     */
    function create_log($data)
    {
        $data['timestamp'] = strtotime(date('Y-m-d') . ' ' . date('H:i:s'));
        $data['ip'] = $_SERVER["REMOTE_ADDR"];
        $data['location'] = 'Desconocido';
        $this->db->insert('log', $data);
    }

    /**
     * Devuelve los settings del sistema.
     */
    function get_system_settings()
    {
        return $this->db->get('settings')->result_array();
    }

    /**
     * Crea un respaldo de la BD o tabla.
     */
    function create_backup($type)
    {
        $this->load->dbutil();

        $options = array(
            'format'      => 'txt',
            'add_drop'    => TRUE,
            'add_insert'  => TRUE,
            'newline'     => "\n"
        );

        if ($type == 'all') {
            $tables = array('');
            $file_name = 'system_backup';
        } else {
            $tables = array('tables' => array($type));
            $file_name = 'backup_' . $type;
        }

        $backup = &$this->dbutil->backup(array_merge($options, $tables));
        $this->load->helper('download');
        force_download($file_name . '.sql', $backup);
    }

    /**
     * Restaura una base de datos desde un archivo SQL cargado.
     */
    function restore_backup()
    {
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/backup.sql');
        $this->load->dbutil();

        $prefs = array(
            'filepath'            => 'uploads/backup.sql',
            'delete_after_upload' => TRUE,
            'delimiter'           => ';'
        );

        $this->dbutil->restore($prefs);
        unlink($prefs['filepath']);
    }

    /**
     * Elimina los datos de las tablas especificadas.
     */
    function truncate($type)
    {
        if ($type == 'all') {
            $this->db->truncate('student');
            $this->db->truncate('mark');
            $this->db->truncate('teacher');
            $this->db->truncate('subject');
            $this->db->truncate('class');
            $this->db->truncate('exam');
            $this->db->truncate('grade');
        } else {
            $this->db->truncate($type);
        }
    }

    /**
     * Devuelve la URL de la imagen de un usuario o imagen por defecto.
     */
    function get_image_url($type = '', $id = '')
    {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg')) {
            return base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
        } else {
            return base_url() . 'uploads/user.jpg';
        }
    }
}