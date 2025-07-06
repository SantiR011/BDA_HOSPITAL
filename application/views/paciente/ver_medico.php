<div class="box">

    <div class="box-header">
        <h5 class="title">Listado de Médicos</h5>
    </div>

    <div class="box-content padded">
        <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Correo</th>
                    <th>Especialidad</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $count = 1;
                foreach ($medicos as $row): 
                    $especialidad = $this->crud_model->get_type_name_by_id('especialidad', $row['especialidad_id'], 'nombre');
                ?>
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td><?php echo $row['nombres']; ?></td>
                    <td><?php echo $row['apellidos']; ?></td>
                    <td><?php echo $row['correo']; ?></td>
                    <td><?php echo $especialidad; ?></td>
                    <td><?php echo $row['telefono_principal']; ?></td>
                    <td><?php echo $row['direccion']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
