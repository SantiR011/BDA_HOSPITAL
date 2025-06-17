<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

        	<?php if(isset($edit_profile)):?>

			<li class="active">

            	<a href="#edit" data-toggle="tab"><i class="icon-wrench"></i> 

					<?php echo ('Editar prescripción');?>

                    	</a></li>

            <?php endif;?>

			<li class="<?php if(!isset($edit_profile))echo 'active';?>">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Lista de prescripción');?>

                    	</a></li>

			<li>

            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>

					<?php echo ('Añadir prescripción');?>

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

                    <?php echo form_open('doctor/manage_prescripcion/edit/do_update/'.$row['prescripcion_id'] , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Doctor');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="doctor_id">

										<?php 

										$doctors	=	$this->db->get('doctor')->result_array();

										foreach($doctors as $row2):

										?>

                                        	<option value="<?php echo $row2['doctor_id'];?>" <?php if($row2['doctor_id'] == $row['doctor_id'])echo 'selected';?>>

												<?php echo $row2['name'];?>

                                            </option>

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

												<?php echo $row2['name'];?>

                                            </option>

                                        <?php

										endforeach;

										?>

									</select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Historia clínica');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="case_history" id="ttt" rows="5" 

                                                	placeholder="<?php echo ('Añadir descripción');?>"><?php echo $row['case_history'];?></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Medicación');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="medication" id="ttt" rows="5" 

                                                	placeholder="<?php echo ('Añadir descripción');?>"><?php echo $row['medication'];?></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Medicamentos del farmacéutico');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="medication_from_pharmacist" id="ttt" rows="5" 

                                                	placeholder="<?php echo ('Añadir descripción');?>"><?php echo $row['medication_from_pharmacist'];?></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Descripción');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="description" id="ttt" rows="5" 

                                                	placeholder="<?php echo ('Añadir descripción');?>"><?php echo $row['description'];?></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Fecha');?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up" name="creation_timestamp" value="<?php echo date('m/d/Y', $row['creation_timestamp']);?>"/>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Editar prescripción');?></button>

                        </div>

                    <?php echo form_close();?>

                    <!---------DIAGNOSIS REPORTS----------->

                    <hr />

                    <div class="box">

                    <div class="box-header"><span class="title"><?php echo ('Informe de diagnóstico');?></span></div>

                    <div class="box-content">

                    	<table cellpadding="0" cellspacing="0" border="0" class="table table-normal ">

                            <thead>

                                <tr>

                                    <td><div>#</div></td>

                                    <td><div><?php echo ('Tipo de informe');?></div></td>

                                    <td><div><?php echo ('Tipo de documento');?></div></td>

                                    <td><div><?php echo ('Descargar');?></div></td>

                                    <td><div><?php echo ('Descripción');?></div></td>

                                    <td><div><?php echo ('Fecha');?></div></td>

                                    <td><div><?php echo ('Laboratorista');?></div></td>

                                </tr>

                            </thead>

                            <tbody>

                                <?php 

                                $count = 1;

                                $diagnostic_reportes	=	$this->db->get_where('informe_diagnostico' , array('prescripcion_id' => $row['prescripcion_id']))->result_array();

                                foreach($diagnostic_reportes as $row2):?>

                                <tr>

                                    <td><?php echo $count++;?></td>

                                    <td><?php echo $row2['reporte_type'];?></td>

                                    <td><?php echo $row2['document_type'];?></td>

                                    <td style="text-align:center;">

                                    	<?php if($row2['document_type'] == 'image'):?>

                                        <div id="thumbs">

  											<a href="<?php echo base_url();?>uploads/informe_diagnostico/<?php echo $row2['file_name'];?>" 

                                            	style="background-image:url(<?php echo base_url();?>uploads/informe_diagnostico/<?php echo $row2['file_name'];?>)" title="<?php echo $row2['file_name'];?>">

                                                	</a></div>

 										<?php endif;?>

                                                    

										<a href="<?php echo base_url();?>uploads/informe_diagnostico/<?php echo $row2['file_name'];?>" target="_blank"

                                        	class="btn btn-primary">	<i class="icon-download-alt"></i> <?php echo ('Download');?></a>

                                    </td>

                                    <td><?php echo $row2['description'];?></td>

                                    <td><?php echo date('d M,Y', $row2['timestamp']);?></td>

                                    <td><?php echo $this->crud_model->get_type_name_by_id('laboratorist',$row2['laboratorist_id'],'name');?></td>

                                    

                                </tr>

                                <?php endforeach;?>

                            </tbody>

                        </table>

                     </div>

                     </div> 

                    <!-------DIAGNOSIS REPORTS ENDS------->

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

                    	<?php $count = 1;foreach($prescripcions as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

                            <td><?php echo date('d M,Y', $row['creation_timestamp']);?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_prescripcion/edit/<?php echo $row['prescripcion_id'];?>"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Edit');?>" class="btn btn-primary">

                                		<i class="icon-wrench"></i>

                                </a>

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_prescripcion/delete/<?php echo $row['prescripcion_id'];?>" onclick="return confirm('delete?')"

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

                    <?php echo form_open('doctor/manage_prescripcion/create/' , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Doctor');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="doctor_id">

										<?php 

										$doctors	=	$this->db->get('doctor')->result_array();

										foreach($doctors as $row):

										?>

                                        	<option value="<?php echo $row['doctor_id'];?>"><?php echo $row['name'];?></option>

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

                                <label class="control-label"><?php echo ('Historia clínica');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="case_history" id="ttt" rows="5" placeholder="<?php echo ('Añadir descripción');?>"></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Medicación');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="medication" id="ttt" rows="5" placeholder="<?php echo ('Añadir descripción');?>"></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Medicamentos del farmacéutico');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="medication_from_pharmacist" id="ttt" rows="5" placeholder="<?php echo ('Añadir descripción');?>"></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Descripción');?></label>

                                <div class="controls">

                                    <div class="box closable-chat-box">

                                        <div class="box-content padded">

                                                <div class="chat-message-box">

                                                <textarea name="description" id="ttt" rows="5" placeholder="<?php echo ('Añadir descripción');?>"></textarea>

                                                </div>

                                        </div>

                                    </div>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Fecha');?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up" name="creation_timestamp" value=""/>

                                </div>

                            </div>

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-success"><?php echo ('Add Prescription');?></button>

                        </div>

                    <?php echo form_close();?>                

                </div>                

			</div>

			<!----CREATION FORM ENDS--->

            

		</div>

	</div>

</div>



