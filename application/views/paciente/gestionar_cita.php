<div class="box">
    <div class="box-header">
        <ul class="nav nav-tabs nav-tabs-left">
            <?php if(isset($edit_profile)): ?>
                <li class="active">
                    <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 
                        <?php echo ('Editar cita'); ?>
                    </a>
                </li>
            <?php endif; ?>
            
            <li class="<?php if(!isset($edit_profile)) echo 'active'; ?>">
                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 
                    <?php echo ('Lista de citas'); ?>
                </a>
            </li>
            
            <li class="<?php if(isset($edit_profile)) echo 'hidden'; ?>">
                <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                    <?php echo ('Añadir cita'); ?>
                </a>
            </li>
        </ul>
    </div>

    <div class="box-content padded">
        <div class="tab-content">
            <?php if(isset($edit_profile)): ?>
                <!-- Pestaña de Edición -->
                <div class="tab-pane box active" id="edit" style="padding: 5px">
                    <div class="box-content">
                        <?php foreach($edit_profile as $row): ?>
                            <?php echo form_open('paciente/gestionar_cita/edit/do_update/'.$row['cita_id'], array('class' => 'form-horizontal validatable')); ?>
                            <div class="padded">
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Médico'); ?></label>
                                    <div class="controls">
                                        <select class="chzn-select" name="numero_id" required>
                                            <?php
                                            $medicos = $this->db->get('medico')->result_array();
                                            foreach($medicos as $medico):
                                            ?>
                                                <option value="<?php echo $medico['numero_id']; ?>" <?php if($medico['numero_id'] == $row['numero_id']) echo 'selected'; ?>>
                                                    <?php echo $medico['nombres'].' '.$medico['apellidos']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Paciente'); ?></label>
                                    <div class="controls">
                                        <select class="chzn-select" name="numero_id" required>
                                            <option value="">Seleccionar paciente</option>
                                            <?php
                                            $this->db->order_by('nombres', 'asc');
                                            $pacientes = $this->db->get('paciente')->result_array();
                                            foreach($pacientes as $paciente):
                                            ?>
                                                <option value="<?php echo $paciente['numero_id']; ?>" <?php if($paciente['numero_id'] == $row['numero_id']) echo 'selected'; ?>>
                                                    <?php echo $paciente['nombres'].' '.$paciente['apellidos']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Especialidad'); ?></label>
                                    <div class="controls">
                                        <select class="chzn-select" name="especialidad_id" required>
                                            <option value="">Seleccionar especialidad</option>
                                            <?php
                                            $this->db->order_by('nombre', 'asc');
                                            $especialidades = $this->db->get('especialidad')->result_array();
                                            foreach($especialidades as $especialidad):
                                            ?>
                                                <option value="<?php echo $especialidad['especialidad_id']; ?>" <?php if($especialidad['especialidad_id'] == $row['especialidad_id']) echo 'selected'; ?>>
                                                    <?php echo $especialidad['nombre']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Lugar'); ?></label>
                                    <div class="controls">
                                        <select class="chzn-select" name="lugar_id" required>
                                            <option value="">Seleccionar lugar</option>
                                            <?php
                                            $this->db->order_by('nombre', 'asc');
                                            $lugares = $this->db->get('lugar')->result_array();
                                            foreach($lugares as $lugar):
                                            ?>
                                                <option value="<?php echo $lugar['lugar_id']; ?>" <?php if($lugar['lugar_id'] == $row['lugar_id']) echo 'selected'; ?>>
                                                    <?php echo $lugar['nombre']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Fecha y Hora'); ?></label>
                                    <div class="controls">
                                        <input type="text" class="datetimepicker" name="fecha_hora" value="<?php echo date('Y-m-d H:i', strtotime($row['fecha_hora'])); ?>" required />
                                    </div>
                                </div>
                                
                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Estado'); ?></label>
                                    <div class="controls">
                                        <select class="chzn-select" name="estado_id" required>
                                            <option value="">Seleccionar estado</option>
                                            <?php
                                            $this->db->order_by('nombre', 'asc');
                                            $estados = $this->db->get('estado_cita')->result_array();
                                            foreach($estados as $estado):
                                            ?>
                                                <option value="<?php echo $estado['estado_id']; ?>" <?php if($estado['estado_id'] == $row['estado_id']) echo 'selected'; ?>>
                                                    <?php echo $estado['nombre']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary"><?php echo ('Actualizar cita'); ?></button>
                                <a href="<?php echo site_url('paciente/gestionar_cita'); ?>" class="btn btn-default"><?php echo ('Cancelar'); ?></a>
                            </div>
                            <?php echo form_close(); ?>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Pestaña de Listado -->
            <div class="tab-pane box <?php if(!isset($edit_profile)) echo 'active'; ?>" id="list">
                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo ('Fecha y Hora'); ?></th>
                            <th><?php echo ('Paciente'); ?></th>
                            <th><?php echo ('Médico'); ?></th>
                            <th><?php echo ('Especialidad'); ?></th>
                            <th><?php echo ('Lugar'); ?></th>
                            <th><?php echo ('Opciones'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; foreach($citas as $row): ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
                            <td><?php echo date('d/m/Y H:i', strtotime($row['fecha_hora'])); ?></td>
                            <td>
                                <?php echo $this->crud_model->get_type_name_by_id('paciente', $row['numero_id'], 'nombres').' '.
                                $this->crud_model->get_type_name_by_id('paciente', $row['numero_id'], 'apellidos'); ?>
                            </td>
                            <td>
                                <?php echo $this->crud_model->get_type_name_by_id('medico', $row['numero_id'], 'nombres').' '.
                                $this->crud_model->get_type_name_by_id('medico', $row['numero_id'], 'apellidos'); ?>
                            </td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('especialidad', $row['especialidad_id'], 'nombre'); ?></td>
                            <td><?php echo $this->crud_model->get_type_name_by_id('lugar', $row['lugar_id'], 'nombre'); ?></td>
                            <td align="center">
                                <a href="<?php echo site_url('paciente/gestionar_cita/edit/'.$row['cita_id']); ?>" 
                                   class="btn btn-primary" title="Editar">
                                    <i class="icon-wrench"></i>
                                </a>
                                <a href="<?php echo site_url('paciente/gestionar_cita/delete/'.$row['cita_id']); ?>" 
                                   class="btn btn-danger" title="Eliminar" 
                                   onclick="return confirm('¿Está seguro de eliminar esta cita?')">
                                    <i class="icon-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Pestaña de Añadir -->
            <div class="tab-pane box" id="add" style="padding: 5px">
                <div class="box-content">
                    <?php echo form_open('paciente/gestionar_cita/create', array('class' => 'form-horizontal validatable')); ?>
                    <div class="padded">
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Médico'); ?></label>
                            <div class="controls">
                                <select class="chzn-select" name="numero_id" required>
                                    <option value="">Seleccionar médico</option>
                                    <?php
                                    $this->db->order_by('nombres', 'asc');
                                    $medicos = $this->db->get('medico')->result_array();
                                    foreach($medicos as $medico):
                                    ?>
                                        <option value="<?php echo $medico['numero_id']; ?>">
                                            <?php echo $medico['nombres'].' '.$medico['apellidos']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Paciente'); ?></label>
                            <div class="controls">
                                <select class="chzn-select" name="numero_id" required>
                                    <option value="">Seleccionar paciente</option>
                                    <?php
                                    $this->db->order_by('nombres', 'asc');
                                    $pacientes = $this->db->get('paciente')->result_array();
                                    foreach($pacientes as $paciente):
                                    ?>
                                        <option value="<?php echo $paciente['numero_id']; ?>">
                                            <?php echo $paciente['nombres'].' '.$paciente['apellidos']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Especialidad'); ?></label>
                            <div class="controls">
                                <select class="chzn-select" name="especialidad_id" required>
                                    <option value="">Seleccionar especialidad</option>
                                    <?php
                                    $this->db->order_by('nombre', 'asc');
                                    $especialidades = $this->db->get('especialidad')->result_array();
                                    foreach($especialidades as $especialidad):
                                    ?>
                                        <option value="<?php echo $especialidad['especialidad_id']; ?>">
                                            <?php echo $especialidad['nombre']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Lugar'); ?></label>
                            <div class="controls">
                                <select class="chzn-select" name="lugar_id" required>
                                    <option value="">Seleccionar lugar</option>
                                    <?php
                                    $this->db->order_by('nombre', 'asc');
                                    $lugares = $this->db->get('lugar')->result_array();
                                    foreach($lugares as $lugar):
                                    ?>
                                        <option value="<?php echo $lugar['lugar_id']; ?>">
                                            <?php echo $lugar['nombre']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="control-group">
                            <label class="control-label"><?php echo ('Fecha y Hora'); ?></label>
                            <div class="controls">
                                <input type="text" class="datetimepicker" name="fecha_hora" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><?php echo ('Crear cita'); ?></button>
                        <button type="reset" class="btn btn-default"><?php echo ('Limpiar'); ?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts necesarios -->
<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

<script>
$(document).ready(function() {
    // Inicializar datetimepicker
    $('.datetimepicker').datetimepicker({
        format: 'Y-m-d H:i',
        minDate: 0
    });
    
    // Inicializar selects con búsqueda
    $(".chzn-select").chosen();
    
    // Manejar el cambio de tabs
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // Re-inicializar chosen después de cambiar de tab
        $(".chzn-select").trigger("chosen:updated");
    });
    
    // Mostrar el tab de añadir cuando se hace clic en el enlace
    $('a[href="#add"]').click(function() {
        $('.nav-tabs li').removeClass('active');
        $(this).parent().addClass('active');
        $('.tab-content .tab-pane').removeClass('active');
        $('#add').addClass('active');
    });
});
</script>