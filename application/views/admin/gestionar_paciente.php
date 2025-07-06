<div class="box">
    <div class="box-header">
        <!-- Pestañas de navegación -->
        <ul class="nav nav-tabs nav-tabs-left">
            <?php if (isset($edit_profile)): ?>
                <li class="active">
                    <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> Editar Paciente</a>
                </li>
            <?php endif; ?>
            <li class="<?php if (!isset($edit_profile))
                echo 'active'; ?>">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> Lista de Pacientes</a>
            </li>
            <li><a href="#add" data-toggle="tab"><i class="icon-plus"></i> Agregar Paciente</a></li>
        </ul>
    </div>

    <div class="box-content padded">
        <div class="tab-content">

            <!-- Formulario de edición -->
            <?php if (isset($edit_profile)): ?>
                <div class="tab-pane box active" id="edit" style="padding: 5px">
                    <div class="box-content">
                        <?php foreach ($edit_profile as $row): ?>
                            <?php echo form_open('admin/gestionar_paciente/edit/do_update/' . $row['numero_id'], array('class' => 'form-horizontal validatable')); ?>
                            <div class="padded">
                                <div class="control-group">
                                    <label class="control-label">Tipo ID</label>
                                    <div class="controls">
                                        <input type="text" name="tipo_id" value="<?php echo $row['tipo_id']; ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Número ID</label>
                                    <div class="controls">
                                        <input type="text" name="numero_id" value="<?php echo $row['numero_id']; ?>" required />
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
                                        <input type="text" name="apellidos" value="<?php echo $row['apellidos']; ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Dirección</label>
                                    <div class="controls">
                                        <input type="text" name="direccion" value="<?php echo $row['direccion']; ?>" required />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Teléfono</label>
                                    <div class="controls">
                                        <input type="text" name="telefono_principal"
                                            value="<?php echo $row['telefono_principal']; ?>" required />
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </div>
                            <?php echo form_close(); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Tabla de médicos -->
            <div class="tab-pane box <?php if (!isset($edit_profile))
                echo 'active'; ?>" id="list">
                <table class="dTable responsive table-hover">
                    <thead>
                        <tr>
                            <th>Número ID</th>
                            <th>Tipo ID</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Correo</th>
                            <th>Direccion</th>
                            <th>Municipio</th>
                            <th>Teléfono</th>
                            <th>Fecha de Nacimiento</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($medicos as $row): ?>
                            <tr>
                                <td><?php echo $row['numero_id']; ?></td>
                                <td><?php echo $row['tipo_id']; ?></td>
                                <td><?php echo $row['nombres']; ?></td>
                                <td><?php echo $row['apellidos']; ?></td>
                                <td><?php echo $row['correo']; ?></td>
                                <td><?php echo $row['direccion']; ?></td>
                                <td><?php echo $row['municipio_id']; ?></td>
                                <td><?php echo $row['telefono_principal']; ?></td>
                                <td><?php echo $row['fecha_nac']; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_paciente/edit/<?php echo $row['numero_id']; ?>"
                                        class="btn btn-primary" rel="tooltip" title="Editar">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    <a href="<?php echo base_url(); ?>index.php?admin/desactivar_paciente/<?php echo $row['numero_id']; ?>"
                                        onclick="return confirm('¿Está seguro de desactivar este paciente?');"
                                        class="btn btn-danger btn-sm">
                                        <i class="icon-remove"></i> Desactivar
                                    </a>


                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Formulario de creación -->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/gestionar_paciente/create', array('class' => 'form-horizontal validatable')); ?>
                    <div class="padded">

                        <div class="control-group">
                            <label class="control-label">Tipo ID</label>
                            <div class="controls"><input type="text" name="tipo_id" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Número ID</label>
                            <div class="controls"><input type="text" name="numero_id" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Nombres</label>
                            <div class="controls"><input type="text" name="nombres" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Apellidos</label>
                            <div class="controls"><input type="text" name="apellidos" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Correo</label>
                            <div class="controls"><input type="email" name="correo" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Contraseña</label>
                            <div class="controls"><input type="password" name="contrasena" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Dirección</label>
                            <div class="controls"><input type="text" name="direccion" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Municipio</label>
                            <div class="controls">
                                <select name="municipio_id" class="chzn-select" required>
                                    <option value="">Seleccione un municipio</option>
                                    <?php foreach ($municipios as $municipio): ?>
                                        <option value="<?= $municipio['municipio_id']; ?>">
                                            <?= $municipio['nombre']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>

                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label">Teléfono</label>
                            <div class="controls"><input type="text" name="telefono_principal" required /></div>
                        </div>

                        <div class="control-group">
                            <label class="control-label">Fecha de Nacimiento</label>
                            <div class="controls"><input type="date" name="fecha_nac" required /></div>
                        </div>

                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn btn-success">Agregar Paciente</button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>

        </div>
    </div>
</div>