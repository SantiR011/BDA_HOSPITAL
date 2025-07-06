<div class="box">
    <div class="box-header">
        <h4 class="title">Pacientes Desactivados</h4>
    </div>

    <div class="box-content padded">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tipo ID</th>
                    <th>Número ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Municipio</th>
                    <th>Teléfono</th>
                    <th>Fecha Nac.</th>
                    <th>Fecha Desactivación</th>
                    <th>Usuario Desactivador</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($pacientes)): ?>
                    <?php foreach ($pacientes as $i => $row): ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= $row['tipo_id'] ?></td>
                            <td><?= $row['numero_id'] ?></td>
                            <td><?= $row['nombres'] ?></td>
                            <td><?= $row['apellidos'] ?></td>
                            <td><?= $row['correo'] ?></td>
                            <td>
                                <?= $this->crud_model->get_type_name_by_id('municipio', $row['municipio_id'], 'nombre'); ?>
                            </td>
                            <td><?= $row['telefono_principal'] ?></td>
                            <td><?= $row['fecha_nac'] ? date('d/m/Y', strtotime($row['fecha_nac'])) : '—' ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($row['fecha_desactivacion'])) ?></td>
                            <td><?= $row['usuario_desactivador'] ?></td>
                            <td>
                                <a href="<?= base_url() ?>index.php?admin/reactivar_paciente/<?= $row['numero_id'] ?>" 
                                   class="btn btn-success btn-sm" 
                                   onclick="return confirm('¿Estás seguro de que deseas reactivar este paciente?');">
                                   Reactivar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="13" class="text-center">No hay pacientes desactivados.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
