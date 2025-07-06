<div class="box">
    <div class="box-header">
        <h4 class="title">Reporte: Citas atendidas por médico</h4>
    </div>

    <div class="box-content padded">
        <?= form_open('', array('class' => 'form-horizontal')); ?>
            <div class="form-group">
                <label class="col-sm-3 control-label">Médico:</label>
                <div class="col-sm-5">
                    <select name="medico_id" class="form-control" required>
                        <option value="">Seleccione un médico</option>
                        <?php foreach ($medicos as $medico): ?>
                            <option value="<?= $medico['numero_id']; ?>" <?= (isset($selected_medico) && $selected_medico == $medico['numero_id']) ? 'selected' : '' ?>>
                                <?= $medico['nombres'] . ' ' . $medico['apellidos']; ?>
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
                    <th>Paciente</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reportes)): ?>
                    <?php foreach ($reportes as $i => $cita): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($cita['fecha_hora'])) ?></td>
                            <td><?= $cita['paciente_nombres'] . ' ' . $cita['paciente_apellidos'] ?></td>
                            <td><?= ucfirst($cita['estado']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">No hay citas atendidas para ese médico y mes.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
