<div class="box">
    <div class="box-header">
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#perfil" data-toggle="tab"><i class="icon-user"></i>
                    <?php echo ('Gestionar Perfil'); ?>
                </a>
            </li>
        </ul>
    </div>

    <div class="box-content padded">
        <div class="tab-content">
            <div class="tab-pane box active" id="perfil" style="padding: 5px">
                <div class="box-content padded">
                    <?php foreach ($edit_profile as $row): ?>
                        <?php echo form_open('paciente/gestionar_perfil/update_profile_info/', array('class' => 'form-horizontal validatable')); ?>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Tipo de ID'); ?></label>
                            <div class="controls">
                                <input type="text" name="tipo_id" value="<?php echo $row['tipo_id']; ?>" required />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Número de ID'); ?></label>
                            <div class="controls">
                                <input type="text" name="numero_id" value="<?php echo $row['numero_id']; ?>" required />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Nombres'); ?></label>
                            <div class="controls">
                                <input type="text" name="nombres" value="<?php echo $row['nombres']; ?>" required />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Apellidos'); ?></label>
                            <div class="controls">
                                <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Correo electrónico'); ?></label>
                            <div class="controls">
                                <input type="email" name="correo" value="<?php echo $row['correo']; ?>" required />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Dirección'); ?></label>
                            <div class="controls">
                                <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required />
                            </div>
                        </div>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Teléfono Principal'); ?></label>
                            <div class="controls">
                                <input type="text" name="telefono_principal" value="<?php echo $row['telefono_principal']; ?>" required />
                            </div>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><?php echo ('Actualizar Perfil'); ?></button>
                        </div>

                        <?php echo form_close(); ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>


<!--password-->

<div class="box">
    <div class="box-header">
        <ul class="nav nav-tabs nav-tabs-left">
            <li class="active">
                <a href="#password" data-toggle="tab"><i class="icon-lock"></i>
                    <?php echo ('Cambiar Contraseña'); ?>
                </a>
            </li>
        </ul>
    </div>

    <div class="box-content padded">
        <?php if ($this->session->flashdata('flash_message')): ?>
            <div class="alert alert-info">
                <?php echo $this->session->flashdata('flash_message'); ?>
            </div>
        <?php endif; ?>

        <div class="tab-content">
            <div class="tab-pane box active" id="password" style="padding: 5px">
                <div class="box-content padded">
                    <?php echo form_open('paciente/gestionar_perfil/change_password/', array('class' => 'form-horizontal validatable')); ?>

                    <div class="control-group">
                        <label class="control-label"><?php echo ('Contraseña Actual'); ?></label>
                        <div class="controls">
                            <input type="password" name="password" class="validate[required]" required />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?php echo ('Nueva Contraseña'); ?></label>
                        <div class="controls">
                            <input type="password" id="new_password" name="new_password" class="validate[required,minSize[6]]" required />
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label"><?php echo ('Confirmar Nueva Contraseña'); ?></label>
                        <div class="controls">
                            <input type="password" name="confirm_new_password" class="validate[required,equals[new_password]]" required />
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-primary"><?php echo ('Actualizar Contraseña'); ?></button>
                    </div>

                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


