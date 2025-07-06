<div class="box">
    <div class="box-header">
        <h4 class="title">Relación de las citas no asistidas sin cancelación previa</h4>
    </div>

    <div class="box-content padded">
        <?= form_open('', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Mes:</label>
                <div class="col-sm-5">
                    <input type="month" name="mes" class="form-control"
                        value="<?= isset($selected_mes) ? $selected_mes : '' ?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" class="btn btn-danger">Buscar</button>
                </div>
            </div>
        </form>

        <hr>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Médico</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reports)): ?>
                    <?php foreach ($reports as $i => $cita): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($cita['fecha_hora'])) ?></td>
                            <td>
                                <?= $this->crud_model->get_type_name_by_id('paciente', $cita['paciente_id'], 'nombres') . ' ' .
                                     $this->crud_model->get_type_name_by_id('paciente', $cita['paciente_id'], 'apellidos'); ?>
                            </td>
                            <td>
                                <?= $this->crud_model->get_type_name_by_id('medico', $cita['medico_id'], 'nombres') . ' ' .
                                     $this->crud_model->get_type_name_by_id('medico', $cita['medico_id'], 'apellidos'); ?>
                            </td>
                            <td><?= ucfirst($cita['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No hay citas ausentes sin cancelación para ese mes.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
