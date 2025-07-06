<?php
    // Cargando el nombre y título del sistema desde la BD
    $system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
    $system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>

<!-- Fuente principal -->
<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/font.css">
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/bootstrap.css">
<!-- Bayanno CSS personalizado -->
<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/bayanno.css">
<!-- Font Awesome (íconos) -->
<link rel="stylesheet" href="<?php echo base_url(); ?>template/css/font-awesome.css">

<!-- jQuery -->
<script src="<?php echo base_url(); ?>template/js/jquery-3.6.0.min.js"></script>
<!-- JS personalizado del sistema -->
<script src="<?php echo base_url(); ?>template/js/bayanno.js"></script>

<!-- Compatibilidad con IE < 9 -->
<!--[if lt IE 9]>
    <script src="<?php echo base_url(); ?>template/js/html5shiv.js"></script>
    <script src="<?php echo base_url(); ?>template/js/excanvas.js"></script>
<![endif]-->
