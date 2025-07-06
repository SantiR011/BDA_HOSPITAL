<div class="box">
    <div class="box-header">
        <h4 class="title">Reporte: Citas médicas por paciente</h4>
    </div>

    <div class="box-content padded">
        <?= form_open('', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Paciente:</label>
                <div class="col-sm-5">
                    <select name="paciente_id" class="form-control" required>
                        <option value="">Seleccione un paciente</option>
                        <?php foreach ($pacientes as $paciente): ?>
                            <option value="<?= $paciente['numero_id']; ?>" <?= (isset($selected_paciente) && $selected_paciente == $paciente['numero_id']) ? 'selected' : '' ?>>
                                <?= $paciente['nombres'] . ' ' . $paciente['apellidos']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-3 control-label">Mes:</label>
                <div class="col-sm-5">
                    <input type="month" name="mes" class="form-control" value="<?= isset($selected_mes) ? $selected_mes : '' ?>" required>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-5">
                    <button type="submit" class="btn btn-info">Buscar</button>
                </div>
            </div>
        </form>

        <hr>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Médico</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reportes)): ?>
                    <?php foreach ($reportes as $i => $cita): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($cita['fecha_hora'])) ?></td>
                            <td><?= $cita['medico_nombres'] . ' ' . $cita['medico_apellidos'] ?></td>
                            <td><?= ucfirst($cita['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No hay citas para ese paciente y mes.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
