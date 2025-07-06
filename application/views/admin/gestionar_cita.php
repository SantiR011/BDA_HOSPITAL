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
         <?php if ($this->session->flashdata('flash_message')): ?>
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('flash_message'); ?>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?= $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>
        <div class="tab-content">
            <?php if(isset($edit_profile)): ?>
                <!-- Pestaña de Edición -->
                <div class="tab-pane box active" id="edit" style="padding: 15px">
                    <div class="box-content">
                        <?php foreach($edit_profile as $row): ?>
                            <?php echo form_open('admin/gestionar_cita/edit/do_update/'.$row['cita_id'], array('class' => 'form-horizontal')); ?>
                            <div class="padded">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Médico</label>
                                    <div class="col-sm-9">
                                        <select class="form-control chosen-select" name="medico_id" required>
                                            <?php
                                            $medicos = $this->db->get('medico')->result_array();
                                            foreach($medicos as $medico):
                                            ?>
                                                <option value="<?php echo $medico['numero_id']; ?>" <?php if($medico['numero_id'] == $row['medico_id']) echo 'selected'; ?>>
                                                    <?php echo $medico['nombres'].' '.$medico['apellidos']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Paciente</label>
                                    <div class="col-sm-9">
                                        <select class="form-control chosen-select" name="paciente_id" required>
                                            <option value="">Seleccionar paciente</option>
                                            <?php
                                            $this->db->order_by('nombres', 'asc');
                                            $pacientes = $this->db->get('paciente')->result_array();
                                            foreach($pacientes as $paciente):
                                            ?>
                                                <option value="<?php echo $paciente['numero_id']; ?>" <?php if($paciente['numero_id'] == $row['paciente_id']) echo 'selected'; ?>>
                                                    <?php echo $paciente['nombres'].' '.$paciente['apellidos']; ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Especialidad</label>
                                    <div class="col-sm-9">
                                        <select class="form-control chosen-select" name="especialidad_id" required>
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
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Lugar</label>
                                    <div class="col-sm-9">
                                        <select class="form-control chosen-select" name="lugar_id" required>
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
                                    <label class="col-sm-3 control-label">Fecha y Hora</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control datetimepicker" name="fecha_hora" value="<?php echo date('Y-m-d H:i', strtotime($row['fecha_hora'])); ?>" required />
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Estado</label>
                                    <div class="col-sm-9">
                                        <select class="form-control chosen-select" name="estado_id" required>
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
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="icon-save"></i> Actualizar cita
                                    </button>
                                    <a href="<?php echo site_url('admin/gestionar_cita'); ?>" class="btn btn-default">
                                        <i class="icon-remove"></i> Cancelar
                                    </a>
                                </div>
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
                            <?php $i = 1; foreach ($citas as $cita): ?>
                                <tr>
                                    <td><?= $i++; ?></td>
                                    <td><?= $this->crud_model->get_full_name_by_id('paciente', $cita['paciente_id']); ?></td>
                                    <td><?= $this->crud_model->get_full_name_by_id('medico', $cita['medico_id']); ?></td>
                                    <td><?= $this->crud_model->get_type_name_by_id('especialidad', $cita['especialidad_id'], 'nombre'); ?></td>
                                    <td><?= $this->crud_model->get_type_name_by_id('lugar', $cita['lugar_id'], 'nombre'); ?></td>
                                    <td><?= date('d/m/Y H:i', strtotime($cita['fecha_hora'])); ?></td>
                                    <td><?= $this->crud_model->obtener_nombre_estado_cita($cita['estado_id']); ?></td>
                                    <td>
                                        <a href="<?= base_url() . 'index.php?admin/gestionar_cita/edit/' . $cita['cita_id']; ?>" class="btn btn-default btn-sm">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        <a href="<?= base_url() . 'index.php?admin/gestionar_cita/delete/' . $cita['cita_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Está seguro de eliminar esta cita?');">
                                            <i class="icon-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pestaña de Añadir -->
            <div class="tab-pane box" id="add" style="padding: 15px">
                <div class="box-content">
                    <?php echo form_open('admin/gestionar_cita/create', array('class' => 'form-horizontal')); ?>
                    <input type="hidden" name="estado_id" value="1"> <!-- Estado Programada por defecto -->
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Paciente:</label>
                        <div class="col-sm-5">
                            <select name="paciente_id" class="form-control chosen-select" required>
                                <option value="">Seleccione un paciente</option>
                                <?php foreach ($pacientes as $paciente): ?>
                                    <option value="<?= $paciente['numero_id']; ?>">
                                        <?= $paciente['nombres'] . ' ' . $paciente['apellidos']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Médico:</label>
                        <div class="col-sm-5">
                            <select name="medico_id" class="form-control chosen-select" required>
                                <option value="">Seleccione un médico</option>
                                <?php foreach ($medicos as $medico): ?>
                                    <option value="<?= $medico['numero_id']; ?>">
                                        <?= $medico['nombres'] . ' ' . $medico['apellidos']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Especialidad:</label>
                        <div class="col-sm-5">
                            <select name="especialidad_id" class="form-control chosen-select" required>
                                <option value="">Seleccione una especialidad</option>
                                <?php foreach ($especialidades as $esp): ?>
                                    <option value="<?= $esp['especialidad_id']; ?>"><?= $esp['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Lugar:</label>
                        <div class="col-sm-5">
                            <select name="lugar_id" class="form-control chosen-select" required>
                                <option value="">Seleccione un lugar</option>
                                <?php foreach ($lugares as $lugar): ?>
                                    <option value="<?= $lugar['lugar_id']; ?>"><?= $lugar['nombre']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Fecha y hora:</label>
                        <div class="col-sm-5">
                            <input type="text" class="form-control datetimepicker" name="fecha_hora" required />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-9">
                            <button type="submit" class="btn btn-success">
                                <i class="icon-ok"></i> Asignar cita
                            </button>
                            <button type="reset" class="btn btn-default">
                                <i class="icon-refresh"></i> Limpiar
                            </button>
                        </div>
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
        minDate: 0,
        step: 15
    });
    
    // Inicializar selects con búsqueda
    $(".chosen-select").chosen({
        width: "100%",
        no_results_text: "No se encontraron resultados para:",
        placeholder_text_single: "Seleccione una opción"
    });
    
    // Validación antes de enviar formulario
    $('form').submit(function(e) {
        var medico = $('select[name="medico_id"]').val();
        var paciente = $('select[name="paciente_id"]').val();
        
        if(medico === '' || medico === '0' || paciente === '' || paciente === '0') {
            e.preventDefault();
            alert('Debe seleccionar tanto un médico como un paciente válidos');
            return false;
        }
    });
    
    // Manejar el cambio de tabs
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        // Re-inicializar chosen después de cambiar de tab
        $(".chosen-select").trigger("chosen:updated");
    });
});
</script>