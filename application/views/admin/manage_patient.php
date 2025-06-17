<div class="box">

    <div class="box">
        <div class="box-header">

            <!------CONTROL TABS START------->
            <ul class="nav nav-tabs nav-tabs-left">
                <?php if (isset($edit_profile)): ?>
                <li class="active">
                    <a href="#edit" data-toggle="tab"><i class="icon-wrench"></i>
                        <?php echo ('Editar paciente'); ?>
                    </a>
                </li>
                <?php endif; ?>
                <li class="<?php if (!isset($edit_profile))
                    echo 'active'; ?>">
                    <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i>
                        <?php echo ('Lista de pacientes'); ?>
                    </a>
                </li>
                <li>
                    <a href="#add" data-toggle="tab"><i class="icon-plus"></i>
                        <?php echo ('Añadir paciente'); ?>
                    </a>
                </li>
            </ul>
            <!------CONTROL TABS END------->

        </div>
        <div class="box-content padded">
            <div class="tab-content">
                <!----EDITING FORM STARTS---->
                <?php if (isset($edit_profile)): ?>
                    <div class="tab-pane box active" id="edit" style="padding: 5px">
                        <div class="box-content">
                            <?php foreach ($edit_profile as $row): ?>
                                <?php echo form_open('admin/manage_paciente/edit/do_update/' . $row['paciente_id'], array('class' => 'form-horizontal validatable')); ?>
                                <div class="padded">

                                    <div class="control-group">
                                        <label class="control-label"><?php echo ('Nombre'); ?></label>
                                        <div class="controls">
                                            <!-- Validación para permitir solo letras, espacios y guiones -->
                                            <input type="text" class="validate[required, custom[onlyLetterSp]]" name="name"
                                                value="<?php echo $row['name']; ?>" />
                                        </div>
                                    </div>


                                </div>

                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Email'); ?></label>
                                    <div class="controls">
                                        <!-- Validación para asegurar que el campo sea obligatorio y tenga formato de correo electrónico -->
                                        <input type="text" class="validate[required, custom[email]]" name="email"
                                            value="<?php echo $row['email']; ?>" />
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Contraseña'); ?></label>
                                    <div class="controls">
                                        <!-- Validación para asegurarse de que el campo sea obligatorio y tenga una longitud mínima de 6 caracteres -->
                                        <input type="password" class="validate[required, minSize[6]]" name="password"
                                            value="<?php echo $row['password']; ?>" />
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Dirección'); ?></label>
                                    <div class="controls">
                                        <!-- Validación para asegurarse de que el campo sea obligatorio -->
                                        <input type="text" class="validate[required]" name="address"
                                            value="<?php echo $row['address']; ?>" />
                                    </div>
                                </div>


                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Teléfono'); ?></label>
                                    <div class="controls">
                                        <!-- Validación para asegurarse de que el campo sea obligatorio y contenga solo números -->
                                        <input type="text" class="validate[required, custom[onlyNumber]]" name="phone"
                                            value="<?php echo $row['phone']; ?>" />
                                    </div>
                                </div>


                                <div class="control-group">

                                    <label class="control-label"><?php echo ('Sexo'); ?></label>

                                    <div class="controls">

                                        <select name="sex" class="uniform" style="width:100%;">

                                            <option value="male" <?php if ($row['sex'] == 'male')
                                                echo 'selected'; ?>>
                                                <?php echo ('Male'); ?></option>

                                            <option value="female" <?php if ($row['sex'] == 'female')
                                                echo 'selected'; ?>>
                                                <?php echo ('Female'); ?></option>

                                        </select>

                                    </div>

                                </div>

                                <div class="control-group">

                                    <label class="control-label"><?php echo ('Fecha de nacimiento'); ?></label>

                                    <div class="controls">

                                        <input type="text" class="datepicker fill-up" name="birth_date"
                                            value="<?php echo $row['birth_date']; ?>" />

                                    </div>

                                </div>

                                <div class="control-group">
                                    <label class="control-label"><?php echo ('Edad'); ?></label>
                                    <div class="controls">
                                        <!-- Validación para asegurarse de que el campo sea obligatorio y esté dentro del rango de 18 a 100 -->
                                        <input type="number" class="validate[required, custom[integer], min[1], max[100]]"
                                            name="age" value="<?php echo $row['age']; ?>" />
                                    </div>
                                </div>


                                <div class="control-group">

                                    <label class="control-label"><?php echo ('Grupo sanguíneo'); ?></label>

                                    <div class="controls">

                                        <select name="blood_group" class="uniform" style="width:100%;">

                                            <option value="A+" <?php if ($row['blood_group'] == 'A+')
                                                echo 'selected'; ?>>A+</option>

                                            <option value="A-" <?php if ($row['blood_group'] == 'A-')
                                                echo 'selected'; ?>>A-</option>

                                            <option value="B+" <?php if ($row['blood_group'] == 'B+')
                                                echo 'selected'; ?>>B+</option>

                                            <option value="B-" <?php if ($row['blood_group'] == 'B-')
                                                echo 'selected'; ?>>B-</option>

                                            <option value="AB+" <?php if ($row['blood_group'] == 'AB+')
                                                echo 'selected'; ?>>AB+
                                            </option>

                                            <option value="AB-" <?php if ($row['blood_group'] == 'AB-')
                                                echo 'selected'; ?>>AB-
                                            </option>

                                            <option value="O+" <?php if ($row['blood_group'] == 'O+')
                                                echo 'selected'; ?>>O+</option>

                                            <option value="O-" <?php if ($row['blood_group'] == 'O-')
                                                echo 'selected'; ?>>O-</option>

                                        </select>

                                    </div>

                                </div>

                            </div>

                            <div class="form-actions">

                                <button type="submit" class="btn btn-primary"><?php echo ('Editar paciente'); ?></button>

                            </div>

                            <?php echo form_close(); ?>

                        <?php endforeach; ?>

                    </div>

                </div>

            <?php endif; ?>

            <!----EDITING FORM ENDS--->



            <!----TABLE LISTING STARTS--->

            <div class="tab-pane box <?php if (!isset($edit_profile))
                echo 'active'; ?>" id="list">



                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                    <thead>

                        <tr>

                            <th>
                                <div>#</div>
                            </th>

                            <th>
                                <div>
                                    <?php echo ('Nombre del paciente'); ?>
                                </div>
                            </th>

                            <th>
                                <div>
                                    <?php echo ('Edad'); ?>
                                </div>
                            </th>

                            <th>
                                <div>
                                    <?php echo ('Sexo'); ?>
                                </div>
                            </th>

                            <th>
                                <div>
                                    <?php echo ('Grupo sanguíneo'); ?>
                                </div>
                            </th>

                            <th>
                                <div>
                                    <?php echo ('Fecha de nacimiento'); ?>
                                </div>
                            </th>

                            <th>
                                <div>
                                    <?php echo ('Opciones'); ?>
                                </div>
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php $count = 1;
                        foreach ($pacientes as $row): ?>

                        <tr>

                            <td>
                                <?php echo $count++; ?>
                            </td>

                            <td>
                                <?php echo $row['name']; ?>
                            </td>

                            <td>
                                <?php echo $row['age']; ?>
                            </td>

                            <td>
                                <?php echo $row['sex']; ?>
                            </td>

                            <td>
                                <?php echo $row['blood_group']; ?>
                            </td>

                            <td>
                                <?php echo $row['birth_date']; ?>
                            </td>

                            <td align="center">

                                <a href="<?php echo base_url(); ?>index.php?admin/manage_paciente/edit/<?php echo $row['paciente_id']; ?>"
                                    rel="tooltip" data-placement="top" data-original-title="<?php echo ('Edit'); ?>"
                                    class="btn btn-primary">

                                    <i class="icon-wrench"></i>

                                </a>

                                <a href="<?php echo base_url(); ?>index.php?admin/manage_paciente/delete/<?php echo $row['paciente_id']; ?>"
                                    onclick="return confirm('delete?')" rel="tooltip" data-placement="top"
                                    data-original-title="<?php echo ('Delete'); ?>" class="btn btn-danger">

                                    <i class="icon-trash"></i>

                                </a>

                            </td>

                        </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

            <!----TABLE LISTING ENDS--->





            <!----CREATION FORM STARTS---->

            <div class="tab-pane box" id="add" style="padding: 5px">

                <div class="box-content">

                    <?php echo form_open('admin/manage_paciente/create/', array('class' => 'form-horizontal validatable')); ?>

                    <form method="post" action="<?php echo base_url(); ?>index.php?" class="form-horizontal validatable">

                        <div class="padded">

                            <div class="control-group">
                                <label class="control-label"><?php echo ('Nombre'); ?></label>
                                <div class="controls">
                                    <!-- Validación para asegurarse de que el campo sea obligatorio y solo contenga letras y espacios -->
                                    <input type="text" class="validate[required, custom[onlyLetterSp]]" name="name" />
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"><?php echo ('Email'); ?></label>
                                <div class="controls">
                                    <!-- Validación para asegurarse de que el campo sea obligatorio y que el formato del correo sea válido -->
                                    <input type="text" class="validate[required, custom[email]]" name="email" />
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"><?php echo ('Contraseña'); ?></label>
                                <div class="controls">
                                    <!-- Validación para asegurarse de que el campo sea obligatorio y tenga una longitud mínima de 6 caracteres -->
                                    <input type="password" class="validate[required, minSize[6]]" name="password" />
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"><?php echo ('Dirección'); ?></label>
                                <div class="controls">
                                    <!-- Validación para asegurarse de que el campo sea obligatorio y solo contenga caracteres alfanuméricos y espacios -->
                                    <input type="text" class="validate[required, custom[onlyLetterNumberSpace]]"
                                        name="address" />
                                </div>
                            </div>


                            <div class="control-group">
                                <label class="control-label"><?php echo ('Teléfono'); ?></label>
                                <div class="controls">
                                    <!-- Validación para asegurar que el campo sea obligatorio y que solo contenga números, guiones o espacios -->
                                    <input type="text" class="validate[required, custom[onlyNumberDashSpace]]"
                                        name="phone" />
                                </div>
                            </div>


                            <div class="control-group">

                                <label class="control-label"><?php echo ('Sexo'); ?></label>

                                <div class="controls">

                                    <select name="sex" class="uniform" style="width:100%;">

                                        <option value="male"><?php echo ('Male'); ?></option>

                                        <option value="female"><?php echo ('Female'); ?></option>

                                    </select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Fecha de nacimiento'); ?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up" name="birth_date" />

                                </div>

                            </div>

                            <div class="control-group">
                                <label class="control-label"><?php echo ('Edad'); ?></label>
                                <div class="controls">
                                    <!-- Validación para asegurarse de que el campo sea obligatorio y que el valor esté dentro de un rango de 1 a 120 -->
                                    <input type="number" class="validate[required, custom[integer], min[1], max[120]]"
                                        name="age" />
                                </div>
                            </div>


                            <div class="control-group">

                                <label class="control-label"><?php echo ('Grupo sanguíneo'); ?></label>

                                <div class="controls">

                                    <select name="blood_group" class="uniform" style="width:100%;">

                                        <option value="A+">A+</option>

                                        <option value="A-">A-</option>

                                        <option value="B+">B+</option>

                                        <option value="B-">B-</option>

                                        <option value="AB+">AB+</option>

                                        <option value="AB-">AB-</option>

                                        <option value="O+">O+</option>

                                        <option value="O-">O-</option>

                                    </select>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-success"><?php echo ('Añadir paciente'); ?></button>

                        </div>

                        <?php echo form_close(); ?>

                </div>

            </div>

            <!----CREATION FORM ENDS--->



        </div>

    </div>

</div>