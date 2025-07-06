<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html>

<head>
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <?php include 'includes.php'; ?>
    <title><?php echo ('Iniciar Sesión'); ?> | <?php echo $system_title; ?></title>
</head>

<body>
    <?php if ($this->session->flashdata('flash_message') != ""): ?>
        <script>
            $(document).ready(function () {
                Growl.info({ title: "<?php echo $this->session->flashdata('flash_message'); ?>", text: " " })
            });
        </script>
    <?php endif; ?>
    <div class="navbar navbar-top navbar-inverse">
        <div class="navbar-inner">
            <div class="container-fluid">
                <a class="brand" href="<?php echo base_url(); ?>"><?php echo $system_name; ?></a>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="span4 offset4">
            <div class="padded">
                <center>
                    <h4>Sistema de Gestión Hospitalaria</h4>
                </center>
                <div class="login box" style="margin-top: 10px;">
                    <div class="box-header">
                        <span class="title"><?php echo ('Panel de Inicio de Sesión'); ?></span>
                    </div>
                    <div class="box-content padded">
                        <i class="m-icon-swapright m-icon-white"></i>
                        <?php echo form_open('login', array('class' => 'separate-sections')); ?>
                        <div class="">
                            <select class="validate[required]" name="login_type" style="width:100%;">
                                <option value=""><?php echo ('--- Seleccione el Tipo de Cuenta ---'); ?></option>
                                <option value="admin"><?php echo ('Administrador'); ?></option>
                                <option value="medico"><?php echo ('Medico'); ?></option>
                                <option value="paciente"><?php echo ('Paciente'); ?></option>
                            </select>
                        </div>
                        <div class="input-prepend">
                            <span class="add-on" href="#">
                                <i class="icon-envelope"></i>
                            </span>
                            <input name="email" type="text" placeholder="<?php echo ('Correo Electrónico'); ?>">
                        </div>
                        <div class="input-prepend">
                            <span class="add-on" href="#">
                                <i class="icon-key"></i>
                            </span>
                            <input name="password" type="password" placeholder="<?php echo ('Contraseña'); ?>">
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success btn-block">
                                <?php echo ('Iniciar Sesión'); ?>
                            </button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <?php include 'application/views/footer.php'; ?>
            </div>
        </div>
    </div>
</body>

</html>