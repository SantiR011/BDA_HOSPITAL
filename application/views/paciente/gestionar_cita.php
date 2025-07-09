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
                                
                                <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha:</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" name="fecha_solo" id="fecha_solo" required min="<?= date('Y-m-d'); ?>" /> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hora:</label>
                        <div class="col-sm-5">
                            <!-- ¡CORRECCIÓN AQUÍ: SE AÑADE 'chosen-select' ! -->
                            <select class="form-control chosen-select" name="hora_solo" id="hora_solo" required>
                                <option value="">Seleccione una hora</option>
                                <!-- Las opciones se generarán con JavaScript -->
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="fecha_hora" id="fecha_hora_oculto" />
                                
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
                <div class="table-responsive">
                    <table class="table table-bordered datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Paciente</th>
                                <th>Médico</th>
                                <th>Especialidad</th>
                                <th>Lugar</th>
                                <th>Fecha y hora</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; foreach ($citas as $cita): if ($cita['estado_id'] != 1) continue; ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $this->crud_model->get_full_name_by_id('paciente', $cita['paciente_id']); ?></td>
                                    <td><?= $this->crud_model->get_full_name_by_id('medico', $cita['medico_id']); ?></td>
                                    <td><?= $this->crud_model->get_type_name_by_id('especialidad', $cita['especialidad_id'], 'nombre'); ?></td>
                                    <td><?= $this->crud_model->get_type_name_by_id('lugar', $cita['lugar_id'], 'nombre'); ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($cita['fecha_hora'])); ?></td>
                                    <td><?= $this->crud_model->obtener_nombre_estado_cita($cita['estado_id']); ?></td>
                                    <td>
    <?php if ($cita['estado_id'] == 1): ?>
        <a href="<?= base_url() . 'index.php?admin/gestionar_cita/edit/' . $cita['cita_id']; ?>" class="btn btn-default btn-sm">
            <i class="icon-pencil"></i>
        </a>
        <a href="<?= base_url() . 'index.php?admin/gestionar_cita/delete/' . $cita['cita_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta cita?');">
            <i class="icon-trash"></i>
        </a>
    <?php endif; ?>
</td>


                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
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
                        
                        <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha:</label>
                        <div class="col-sm-5">
                            <input type="date" class="form-control" name="fecha_solo" id="fecha_solo" required min="<?= date('Y-m-d'); ?>" /> 
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Hora:</label>
                        <div class="col-sm-5">
                            <!-- ¡CORRECCIÓN AQUÍ: SE AÑADE 'chosen-select' ! -->
                            <select class="form-control chosen-select" name="hora_solo" id="hora_solo" required>
                                <option value="">Seleccione una hora</option>
                                <!-- Las opciones se generarán con JavaScript -->
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="fecha_hora" id="fecha_hora_oculto" />
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
    // Generar las opciones de hora con intervalos de 30 minutos
    var horaSelect = $('#hora_solo');
    for (var h = 7; h <= 22; h++) { // Desde las 7 AM hasta las 10 PM
        var horaStr = (h < 10 ? '0' : '') + h;
        // Intervalo de :00
        horaSelect.append($('<option>', {
            value: horaStr + ':00',
            text: horaStr + ':00'
        }));
        // Intervalo de :30, si no es la última hora y ya hemos añadido la de :00
        if (h < 22 || (h === 22 && horaStr + ':00' !== '22:00')) { // Evita 22:30 si 22:00 es el límite
             horaSelect.append($('<option>', {
                value: horaStr + ':30',
                text: horaStr + ':30'
            }));
        }
    }
    // Asegurarse de que si el límite es 22:00, no se añada 22:30.
    // La lógica de arriba ya lo debería manejar si h < 22. Si h es 22, solo se añade 22:00.


    // Actualizar el campo oculto cuando cambie la fecha o la hora
    function actualizarFechaHoraOculto() {
        var fecha = $('#fecha_solo').val();
        var hora = $('#hora_solo').val();
        if (fecha && hora) {
            $('#fecha_hora_oculto').val(fecha + ' ' + hora);
        } else {
            $('#fecha_hora_oculto').val('');
        }
    }

    $('#fecha_solo').on('change', actualizarFechaHoraOculto);
    $('#hora_solo').on('change', actualizarFechaHoraOculto);

    // Si estás en modo edición y ya hay un valor, inicializar los campos
    // Esto requerirá parsear la fecha_hora existente en 'Y-m-d H:i'
    <?php if(isset($edit_profile)): ?>
        var existingDateTime = "<?php echo date('Y-m-d H:i', strtotime($row['fecha_hora'])); ?>";
        if (existingDateTime) {
            var parts = existingDateTime.split(' ');
            $('#fecha_solo').val(parts[0]);
            $('#hora_solo').val(parts[1]);
            actualizarFechaHoraOculto(); // Para inicializar el campo oculto
        }
    <?php endif; ?>

    // --- Tu código de Chosen.js y validación de formulario se mantiene igual ---
    $(".chosen-select").chosen({ /* ... */ });
    $('form').submit(function(e) { /* ... */ });
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) { /* ... */ });
});
</script>