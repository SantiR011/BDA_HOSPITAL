<div class="box">
    <div class="box-header">
        <!------CONTROL TABS START------->
        <ul class="nav nav-tabs nav-tabs-left">
            <?php if (isset($edit_profile)) : ?>
                <li class="active">
                    <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i>
                        <?php echo ('Editar Especialidad'); ?>
                    </a>
                </li>
            <?php endif; ?>
            <li class="<?php if (!isset($edit_profile)) echo 'active'; ?>">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i>
                    <?php echo ('Lista de Especialidades'); ?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo ('Agregar Especialidad'); ?>
                </a>
            </li>
        </ul>
        <!------CONTROL TABS END------->
    </div>

    <div class="box-content padded">
        <div class="tab-content">

            <!-- EDITING FORM START -->
            <?php if (isset($edit_profile)) : ?>
                <div class="tab-pane box active" id="edit" style="padding: 5px">
                    <div class="box-content">
                        <?php foreach ($edit_profile as $row) : ?>
                            <?php echo form_open('admin/gestionar_especialidad/edit/do_update/' . $row['especialidad_id'], array('class' => 'form-horizontal validatable')); ?>
                            <div class="padded">
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Nombre de la Especialidad'); ?></label>
                                    <div class="controls">
                                        <input type="text" 
                                               class="validate[required]" 
                                               name="nombre" 
                                               value="<?php echo $row['nombre']; ?>" 
                                               required 
                                               maxlength="50" 
                                               pattern="[A-Za-z\s]+" 
                                               title="Solo se permiten letras y espacios" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Descripción de la Especialidad'); ?></label>
                                    <div class="controls">
                                        <input type="text" 
                                               class="" 
                                               name="descripcion" 
                                               value="<?php echo $row['descripcion']; ?>" 
                                               required 
                                               maxlength="255" 
                                               title="Descripción no puede estar vacía." />
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"><?php echo ('Editar Especialidad'); ?></button>
                            </div>
                            <?php echo form_close(); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- EDITING FORM END -->

            <!-- TABLE LISTING START -->
            <div class="tab-pane box <?php if (!isset($edit_profile)) echo 'active'; ?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo ('Nombre de la Especialidad'); ?></div></th>
                            <th><div><?php echo ('Descripción'); ?></div></th>
                            <th><div><?php echo ('Opciones'); ?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;
                        foreach ($especialidades as $row) : ?>
                            <tr>
                                <td><?php echo $count++; ?></td>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><?php echo $row['descripcion']; ?></td>
                                <td align="center">
                                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_especialidad/edit/<?php echo $row['especialidad_id']; ?>"
                                       rel="tooltip" data-placement="top" data-original-title="<?php echo ('Editar'); ?>" class="btn btn-primary">
                                        <i class="icon-wrench"></i>
                                    </a>
                                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_especialidad/delete/<?php echo $row['especialidad_id']; ?>" 
                                       onclick="return confirm('¿Eliminar?')" 
                                       rel="tooltip" data-placement="top" data-original-title="<?php echo ('Eliminar'); ?>" class="btn btn-danger">
                                        <i class="icon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- TABLE LISTING END -->

            <!-- CREATION FORM START -->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/gestionar_especialidad/create', array('class' => 'form-horizontal validatable')); ?>
                    <div class="padded">
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Nombre de la Especialidad'); ?></label>
                            <div class="controls">
                                <input type="text" 
                                       class="validate[required]" 
                                       name="nombre" 
                                       required 
                                       maxlength="50" 
                                       pattern="[A-Za-z\s]+" 
                                       placeholder="Escribe el nombre de la especialidad" 
                                       title="Solo se permiten letras y espacios" />
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Descripción de la Especialidad'); ?></label>
                            <div class="controls">
                                <input type="text" 
                                       class="" 
                                       name="descripcion" 
                                       required 
                                       maxlength="255" 
                                       placeholder="Escribe una descripción" 
                                       title="Descripción no puede estar vacía." />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><?php echo ('Agregar Especialidad'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
            <!-- CREATION FORM END -->

        </div>
    </div>
</div>
