<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">



			<li class="<?php if(!isset($edit_profile))echo 'active';?>">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Configuración del sistema');?>

                    	</a></li>

		</ul>

    	<!------CONTROL TABS END------->

        

	</div>

	<div class="box-content padded">

		<div class="tab-content">

        	<!----EDITING FORM STARTS---->

			<div class="tab-pane box active" id="edit" style="padding: 5px">

                <div class="box-content padded">

					<?php 

                    foreach($settings as $row):

                        ?>

                        <?php echo form_open('admin/system_settings/'.$row['type'].'/do_update/' , array('class' => 'form-horizontal validatable'));?>                            

                            <div class="control-group">

                                <label class="control-label"><?php echo ($row['type']);?></label>

                                <div class="controls">

                                    <input type="text" class="" name="description" value="<?php echo $row['description'];?>"/>

                                    <button type="submit" class="btn btn-primary"><?php echo ('Guardar');?></button>

                                </div>

                            </div>

                        <?php echo form_close();?>

						<?php

                    endforeach;

                    ?>

                </div>

			</div>

            <!----EDITING FORM ENDS--->

            

		</div>

	</div>

</div>