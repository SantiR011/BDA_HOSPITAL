<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

        	<?php if(isset($edit_profile)):?>

			<li class="active">

            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 

					<?php echo ('Editar asignación de camas');?>

                    	</a></li>

            <?php endif;?>

			<li class="<?php if(!isset($edit_profile))echo 'active';?>">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Lista de adjudicación de camas');?>

                    	</a></li>

			<li>

            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>

					<?php echo ('Añadir cama');?>

                    	</a></li>

		</ul>

    	<!------CONTROL TABS END------->

        

	</div>

	<div class="box-content padded">

		<div class="tab-content">

        	<!----EDITING FORM STARTS---->

        	<?php if(isset($edit_profile)):?>

			<div class="tab-pane box active" id="edit" style="padding: 5px">

                <div class="box-content">

                	<?php foreach($edit_profile as $row):?>

                    <?php echo form_open('doctor/manage_bed_allotment/edit/do_update/'.$row['bed_allotment_id'] , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Número de cama');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="bed_id">

										<?php 

										$this->db->order_by('type' , 'asc');

										$beds	=	$this->db->get('bed')->result_array();

										foreach($beds as $row2):

										?>

                                        	<option value="<?php echo $row2['bed_id'];?>" <?php if($row2['bed_id'] == $row['bed_id'])echo 'selected';?>>

												<?php echo $row2['bed_number'].' - '.$row2['type'];?></option>

                                        <?php

										endforeach;

										?>

									</select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Paciente');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="paciente_id">

										<?php 

										$this->db->order_by('account_opening_timestamp' , 'asc');

										$pacientes	=	$this->db->get('paciente')->result_array();

										foreach($pacientes as $row2):

										?>

                                        	<option value="<?php echo $row2['paciente_id'];?>" <?php if($row2['paciente_id'] == $row['paciente_id'])echo 'selected';?>>

												<?php echo $row2['name'];?></option>

                                        <?php

										endforeach;

										?>

									</select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Hora de adjudicación');?></label>

                                <div class="controls">

                                    <input type="date" class="fill-up" name="allotment_timestamp" />

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Tiempo de alta');?></label>

                                <div class="controls">

                                    <input type="date" class="fill-up" name="discharge_timestamp" />

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Editar asignación de camas');?></button>

                        </div>

                    <?php echo form_close();?>

                    <?php endforeach;?>

                </div>

			</div>

            <?php endif;?>

            <!----EDITING FORM ENDS--->

            

            <!----TABLE LISTING STARTS--->

            <div class="tab-pane box <?php if(!isset($edit_profile))echo 'active';?>" id="list">

				

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                	<thead>

                		<tr>

                    		<th><div>#</div></th>

                    		<th><div><?php echo ('Número de cama');?></div></th>

                    		<th><div><?php echo ('Tipo de cama');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

                    		<th><div><?php echo ('Fecha de adjudicación');?></div></th>

                    		<th><div><?php echo ('Fecha de alta');?></div></th>

                    		<th><div><?php echo ('Opciones');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php $count = 1;foreach($bed_allotment as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'bed_number');?></td>

                            <td><?php echo $this->crud_model->get_type_name_by_id('bed',$row['bed_id'],'type');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

                            <td><?php echo ( $row['allotment_timestamp']);?></td>

                            <td><?php echo ($row['discharge_timestamp']);?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_bed_allotment/edit/<?php echo $row['bed_allotment_id'];?>"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Edit');?>" class="btn btn-primary">

                                		<i class="icon-wrench"></i>

                                </a>

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_bed_allotment/delete/<?php echo $row['bed_allotment_id'];?>" onclick="return confirm('delete?')"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Delete');?>" class="btn btn-danger">

                                		<i class="icon-trash"></i>

                                </a>

        					</td>

                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

			</div>

            <!----TABLE LISTING ENDS--->

            

            

			<!----CREATION FORM STARTS---->

			<div class="tab-pane box" id="add" style="padding: 5px">

                <div class="box-content">

                    <?php echo form_open('doctor/manage_bed_allotment/create/' , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Número de cama');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="bed_id">

										<?php 

										$this->db->order_by('type' , 'asc');

										$beds	=	$this->db->get('bed')->result_array();

										foreach($beds as $row):

										?>

                                        	<option value="<?php echo $row['bed_id'];?>"><?php echo $row['bed_number'].' - '.$row['type'];?></option>

                                        <?php

										endforeach;

										?>

									</select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Paciente');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="paciente_id">

										<?php 

										$this->db->order_by('account_opening_timestamp' , 'asc');

										$pacientes	=	$this->db->get('paciente')->result_array();

										foreach($pacientes as $row):

										?>

                                        	<option value="<?php echo $row['paciente_id'];?>"><?php echo $row['name'];?></option>

                                        <?php

										endforeach;

										?>

									</select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Hora de adjudicación');?></label>

                                <div class="controls">

                                    <input type="date" class="fill-up" name="allotment_timestamp"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Tiempo de alta');?></label>

                                <div class="controls">

                                    <input type="date" class="fill-up" name="discharge_timestamp"/>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Añadir asignación de cama');?></button>

                        </div>

                    <?php echo form_close();?>                

                </div>                

			</div>

			<!----CREATION FORM ENDS--->

            

		</div>

	</div>

</div>