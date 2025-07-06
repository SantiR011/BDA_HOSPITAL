<div class="box">

    <div class="box">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <?php if (isset($edit_profile)): ?>
                <li class="active">
                    <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i>
                        <?php echo ('Editar paciente'); ?>
                    </a>
                </li>
                <?php endif; ?>
                <li class="<?php if (!isset($edit_profile))
                    echo 'active'; ?>">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i>
                        <?php echo ('Lista de pacientes'); ?>
                    </a>
                </li>
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----EDITING FORM STARTS---->
                <?php if (isset($edit_profile)): ?>
                    <div class="tab-pane box active" id="edit" style="padding: 5px">
                        <div class="box-content">
                            <?php foreach ($edit_profile as $row): ?>
                                <?php echo form_open('admin/gestionar_paciente/edit/do_update/' . $row['numero_id'], array('class' => 'form-horizontal validatable')); ?>
                                <div class="padded">

                                    <div class="control-group">
                                        <label class="control-label">Tipo de ID</label>
                                        <div class="controls">
                                            <input type="text" name="tipo_id" value="<?php echo $row['tipo_id']; ?>" required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Número de ID</label>
                                        <div class="controls">
                                            <input type="text" name="numero_id" value="<?php echo $row['numero_id']; ?>"
                                                required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Nombres</label>
                                        <div class="controls">
                                            <input type="text" name="nombres" value="<?php echo $row['nombres']; ?>" required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Apellidos</label>
                                        <div class="controls">
                                            <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>"
                                                required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Correo</label>
                                        <div class="controls">
                                            <input type="email" name="correo" value="<?php echo $row['correo']; ?>" required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Contraseña</label>
                                        <div class="controls">
                                            <input type="password" name="contrasena" value="<?php echo $row['contrasena']; ?>"
                                                required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Dirección</label>
                                        <div class="controls">
                                            <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>"
                                                required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Teléfono</label>
                                        <div class="controls">
                                            <input type="text" name="telefono_principal"
                                                value="<?php echo $row['telefono_principal']; ?>" required />
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label">Fecha de nacimiento</label>
                                        <div class="controls">
                                            <input type="date" name="fecha_nac" value="<?php echo $row['fecha_nac']; ?>"
                                                required />
                                        </div>
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-primary">Actualizar paciente</button>
                                    </div>

                                </div>
                                <?php echo form_close(); ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>


                <!----EDITING FORM ENDS--->



                <!----TABLE LISTING STARTS--->

                <div class="tab-pane box <?php if (!isset($edit_profile))
                    echo 'active'; ?>" id="list">
                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Correo</th>
                                <th>Teléfono</th>
                                <th>Fecha de nacimiento</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 1;
                            foreach ($pacientes as $row): ?>
                            <tr>
                                <td>
                                    <?php echo $count++; ?>
                                </td>
                                <td>
                                    <?php echo $row['nombres']; ?>
                                </td>
                                <td>
                                    <?php echo $row['apellidos']; ?>
                                </td>
                                <td>
                                    <?php echo $row['correo']; ?>
                                </td>
                                <td>
                                    <?php echo $row['telefono_principal']; ?>
                                </td>
                                <td>
                                    <?php echo $row['fecha_nac']; ?>
                                </td>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>index.php?medico/gestionar_paciente/edit/<?php echo $row['numero_id']; ?>"
                                        class="btn btn-primary" rel="tooltip" data-original-title="Editar">
                                        <i class="icon-wrench"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>



                <!----CREATION FORM ENDS--->



            </div>

        </div>

    </div>