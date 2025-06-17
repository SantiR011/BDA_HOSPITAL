<div class="box">
    <div class="box-header">
        <!-- CONTROL TABS START -->
        <ul class="nav nav-tabs nav-tabs-left">
            <?php if(isset($edit_profile)):?>
            <li class="active">
                <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
                    <?php echo ('Editar Enfermero');?>
                </a>
            </li>
            <?php endif;?>
            <li class="<?php if(!isset($edit_profile))echo 'active';?>">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo ('Lista de Enfermeros');?>
                </a>
            </li>
            <li>
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo ('Agregar Enfermero');?>
                </a>
            </li>
        </ul>
        <!-- CONTROL TABS END -->
    </div>

    <div class="box-content padded">
        <div class="tab-content">
            <!-- EDITING FORM STARTS -->
            <?php if(isset($edit_profile)):?>
            <div class="tab-pane box active" id="edit" style="padding: 5px">
                <div class="box-content">
                    <?php foreach($edit_profile as $row):?>
                    <?php echo form_open('admin/manage_medico/edit/do_update/'.$row['medico_id'] , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Nombre');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required, custom[onlyLetterSp]]" name="name" value="<?php echo $row['name'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Correo Electrónico');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required, custom[email]]" name="email" value="<?php echo $row['email'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Contraseña');?></label>
                                <div class="controls">
                                    <input type="password" class="validate[required]" name="password" value="<?php echo $row['password'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Dirección');?></label>
                                <div class="controls">
                                    <input type="text" name="address" value="<?php echo $row['address'];?>"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Teléfono');?></label>
                                <div class="controls">
                                    <input type="text" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary"><?php echo ('Editar Enfermero');?></button>
                        </div>
                    <?php echo form_close();?>
                    <?php endforeach;?>
                </div>
            </div>
            <?php endif;?>
            <!-- EDITING FORM ENDS -->

            <!-- TABLE LISTING STARTS -->
            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo ('Nombre del Enfermero');?></div></th>
                            <th><div><?php echo ('Correo Electrónico');?></div></th>
                            <th><div><?php echo ('Dirección');?></div></th>
                            <th><div><?php echo ('Teléfono');?></div></th>
                            <th><div><?php echo ('Opciones');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1;foreach($medicos as $row):?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><?php echo $row['name'];?></td>
                            <td><?php echo $row['email'];?></td>
                            <td><?php echo $row['address'];?></td>
                            <td><?php echo $row['phone'];?></td>
                            <td align="center">
                                <a href="<?php echo base_url();?>index.php?admin/manage_medico/edit/<?php echo $row['medico_id'];?>"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo ('Editar');?>" class="btn btn-primary">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a href="<?php echo base_url();?>index.php?admin/manage_medico/delete/<?php echo $row['medico_id'];?>" onclick="return confirm('¿Eliminar?')"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo ('Eliminar');?>" class="btn btn-danger">
                                    <i class="icon-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </tbody>
                </table>
            </div>
            <!-- TABLE LISTING ENDS -->

            <!-- CREATION FORM STARTS -->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('admin/manage_medico/create/' , array('class' => 'form-horizontal validatable'));?>
                        <div class="padded">
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Nombre');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required, custom[onlyLetterSp]]" name="name"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Correo Electrónico');?></label>
                                <div class="controls">
                                    <input type="text" class="validate[required, custom[email]]" name="email"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Contraseña');?></label>
                                <div class="controls">
                                    <input type="password" class="validate[required]" name="password"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Dirección');?></label>
                                <div class="controls">
                                    <input type="text" name="address"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label"><?php echo ('Teléfono');?></label>
                                <div class="controls">
                                <input type="text" class="validate[required, custom[onlyNumber]]" name="phone" value="<?php echo $row['phone'];?>"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn btn-success"><?php echo ('Agregar Enfermero');?></button>
                        </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <!-- CREATION FORM ENDS -->
        </div>
    </div>
</div>
