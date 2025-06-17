<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

        	<?php if(isset($edit_profile)):?>

			<li class="active">

            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 

					<?php echo ('Editar cita');?>

                    	</a></li>

            <?php endif;?>

			<li class="<?php if(!isset($edit_profile))echo 'active';?>">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Lista de citas');?>

                    	</a></li>

			<li>

            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>

					<?php echo ('Añadir cita');?>

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

                    <?php echo form_open('doctor/manage_cita/edit/do_update/'.$row['cita_id'] , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Doctor');?></label>

                                <div class="controls" style="padding-top:6px;">

                                	<?php echo $this->crud_model->get_type_name_by_id('doctor' ,$this->session->userdata('doctor_id') , 'name');?>

                                    <input type="hidden" name="doctor_id" value="<?php echo $this->session->userdata('doctor_id');?>"  />

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

                                <label class="control-label"><?php echo ('Fecha');?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up" name="cita_timestamp" value="<?php echo date('m/d/Y', $row['cita_timestamp']);?>"/>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Editar cita');?></button>

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

                    		<th><div><?php echo ('Fecha');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

                    		<th><div><?php echo ('Doctor');?></div></th>

                    		<th><div><?php echo ('Opciones');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php $count = 1;foreach($citas as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

                            <td><?php echo date('d M,Y', $row['cita_timestamp']);?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_cita/edit/<?php echo $row['cita_id'];?>"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Edit');?>" class="btn btn-primary">

                                		<i class="icon-wrench"></i>

                                </a>

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_cita/delete/<?php echo $row['cita_id'];?>" onclick="return confirm('delete?')"

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

                    <?php echo form_open('doctor/manage_cita/create/' , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Doctor');?></label>

                                <div class="controls" style="padding-top:6px;">

                                	<?php echo $this->crud_model->get_type_name_by_id('doctor' ,$this->session->userdata('doctor_id') , 'name');?>

                                    <input type="hidden" name="doctor_id" value="<?php echo $this->session->userdata('doctor_id');?>"  />

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

                                <label class="control-label"><?php echo ('Fecha');?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up" name="cita_timestamp"/>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-success"><?php echo ('Añadir cita');?></button>

                        </div>

                    <?php echo form_close();?>                

                </div>                

			</div>

			<!----CREATION FORM ENDS--->

            

		</div>

	</div>

</div>