<div class="box">

    <div class="box-header">



        <!------CONTROL TABS START------->

        <ul class="nav nav-tabs nav-tabs-left">



            <li class="active">

                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i>

                    <?php echo ('Administrar perfil'); ?>

                </a>
            </li>

        </ul>

        <!------CONTROL TABS END------->



    </div>

    <div class="box-content padded">

        <div class="tab-content">

            <!----EDITING FORM STARTS---->

            <div class="tab-pane box active" id="list" style="padding: 5px">

                <div class="box-content padded">

                    <?php

                    foreach ($edit_profile as $row):

                        ?>

                        <?php echo form_open('doctor/manage_profile/update_profile_info/', array('class' => 'form-horizontal validatable')); ?>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Nombre'); ?></label>
                            <div class="controls">
                                <input type="text" class="validate[required,custom[onlyLetterSp],minSize[3],maxSize[50]]"
                                    name="name" value="<?php echo $row['name']; ?>" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label"><?php echo ('Email'); ?></label>
                            <div class="controls">
                                <input type="text" class="validate[required,custom[email]]" name="email"
                                    value="<?php echo $row['email']; ?>" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label"><?php echo ('Dirección'); ?></label>
                            <div class="controls">
                                <input type="text" class="validate[required]" name="address"
                                    value="<?php echo $row['address']; ?>" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label"><?php echo ('Teléfono'); ?></label>
                            <div class="controls">
                                <input type="text" class="validate[required,custom[phone]]" name="phone"
                                    value="<?php echo $row['phone']; ?>" />
                            </div>
                        </div>


                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Actualizar perfil'); ?></button>

                        </div>

                        <?php echo form_close(); ?>

                        <?php

                    endforeach;

                    ?>

                </div>

            </div>

            <!----EDITING FORM ENDS--->



        </div>

    </div>

</div>





<!--password-->

<div class="box">

    <div class="box-header">



        <!------CONTROL TABS START------->

        <ul class="nav nav-tabs nav-tabs-left">



            <li class="active">

                <a href="#list" data-toggle="tab"><i class="icon-lock"></i>

                    <?php echo ('Cambiar la contraseña'); ?>

                </a>
            </li>

        </ul>

        <!------CONTROL TABS END------->



    </div>

    <div class="box-content padded">

        <div class="tab-content">

            <!----EDITING FORM STARTS---->

            <div class="tab-pane box active" id="list" style="padding: 5px">

                <div class="box-content padded">

                    <?php

                    foreach ($edit_profile as $row):

                        ?>

                        <?php echo form_open('doctor/manage_profile/change_password/', array('class' => 'form-horizontal validatable')); ?>

                        <div class="control-group">
                            <label class="control-label"><?php echo ('Contraseña'); ?></label>
                            <div class="controls">
                                <input type="password" class="validate[required,minSize[6],maxSize[20]]" name="password"
                                    value="" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label"><?php echo ('Nueva contraseña'); ?></label>
                            <div class="controls">
                                <input type="password" class="validate[required,minSize[6],maxSize[20]]" name="new_password"
                                    value="" />
                            </div>
                        </div>


                        <div class="control-group">
                            <label class="control-label"><?php echo ('Confirmar nueva contraseña'); ?></label>
                            <div class="controls">
                                <input type="password" class="validate[required,equals[new_password]]"
                                    name="confirm_new_password" value="" />
                            </div>
                        </div>


                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Actualizar contraseña'); ?></button>

                        </div>

                        <?php echo form_close(); ?>

                        <?php

                    endforeach;

                    ?>

                </div>

            </div>

            <!----EDITING FORM ENDS--->



        </div>

    </div>

</div>