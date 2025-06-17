<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

			<li class="active">

            	<a href="#operation" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Operación');?>

                    	</a></li>

			<li>

            	<a href="#birth" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Nacimiento');?>

                    	</a></li>

			<li>

            	<a href="#death" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Muerte');?>

                    	</a></li>

			<li>

            	<a href="#other" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Otro');?>

                    	</a></li>

			<li>

            	<a href="#add" data-toggle="tab"><i class="icon-plus"></i>

					<?php echo ('Agregar informe');?>

                    	</a></li>

		</ul>

    	<!------CONTROL TABS END------->

        

	</div>

	<div class="box-content padded">

		<div class="tab-content">            

            <!----OPERATION LISTING STARTS--->

            <div class="tab-pane box active" id="operation">

				

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                	<thead>

                		<tr>

                    		<th><div>#</div></th>

                    		<th><div><?php echo ('Descripción');?></div></th>

                    		<th><div><?php echo ('Fecha');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

                    		<th><div><?php echo ('Doctor');?></div></th>

                    		<th><div><?php echo ('Opciones');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php 

						$count = 1;

						$birth_reportes	=	$this->db->get_where('reporte' , array('type'=>'operation'))->result_array();

						foreach($birth_reportes as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

                            <td><?php echo $row['description'];?></td>

                            <td><?php echo date('d M,Y', $row['timestamp']);?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_reporte/delete/<?php echo $row['reporte_id'];?>" onclick="return confirm('delete?')"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Delete');?>" class="btn btn-danger">

                                		<i class="icon-trash"></i>

                                </a>

        					</td>

                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

			</div>

            <!----OPERATION LISTING ENDS--->

            

            <!----BIRTH LISTING STARTS--->

            <div class="tab-pane box" id="birth">

				

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                	<thead>

                		<tr>

                    		<th><div>#</div></th>

                    		<th><div><?php echo ('Descripción');?></div></th>

                    		<th><div><?php echo ('Fecha');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

                    		<th><div><?php echo ('Doctor');?></div></th>

                    		<th><div><?php echo ('Opciones');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php 

						$count = 1;

						$birth_reportes	=	$this->db->get_where('reporte' , array('type'=>'birth'))->result_array();

						foreach($birth_reportes as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

                            <td><?php echo $row['description'];?></td>

                            <td><?php echo date('d M,Y', $row['timestamp']);?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_reporte/delete/<?php echo $row['reporte_id'];?>" onclick="return confirm('delete?')"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Delete');?>" class="btn btn-danger">

                                		<i class="icon-trash"></i>

                                </a>

        					</td>

                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

			</div>

            <!----BIRTH LISTING ENDS--->

            

            <!----DEATH LISTING STARTS--->

            <div class="tab-pane box" id="death">

				

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                	<thead>

                		<tr>

                    		<th><div>#</div></th>

                    		<th><div><?php echo ('Descripción');?></div></th>

                    		<th><div><?php echo ('Fecha');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

                    		<th><div><?php echo ('Doctor');?></div></th>

                    		<th><div><?php echo ('Opciones');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php 

						$count = 1;

						$birth_reportes	=	$this->db->get_where('reporte' , array('type'=>'death'))->result_array();

						foreach($birth_reportes as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

                            <td><?php echo $row['description'];?></td>

                            <td><?php echo date('d M,Y', $row['timestamp']);?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_reporte/delete/<?php echo $row['reporte_id'];?>" onclick="return confirm('delete?')"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Delete');?>" class="btn btn-danger">

                                		<i class="icon-trash"></i>

                                </a>

        					</td>

                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

			</div>

            <!----DEATH LISTING ENDS--->

            

            <!----OTHER LISTING STARTS--->

            <div class="tab-pane box" id="other">

				

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                	<thead>

                		<tr>

                    		<th><div>#</div></th>

                    		<th><div><?php echo ('Descripción');?></div></th>

                    		<th><div><?php echo ('Fecha');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

                    		<th><div><?php echo ('Doctor');?></div></th>

                    		<th><div><?php echo ('Opciones');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php 

						$count = 1;

						$birth_reportes	=	$this->db->get_where('reporte' , array('type'=>'other'))->result_array();

						foreach($birth_reportes as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

                            <td><?php echo $row['description'];?></td>

                            <td><?php echo date('d M,Y', $row['timestamp']);?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							<td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

							<td align="center">

                            	<a href="<?php echo base_url();?>index.php?doctor/manage_reporte/delete/<?php echo $row['reporte_id'];?>" onclick="return confirm('delete?')"

                                	rel="tooltip" data-placement="top" data-original-title="<?php echo ('Delete');?>" class="btn btn-danger">

                                		<i class="icon-trash"></i>

                                </a>

        					</td>

                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

			</div>

            <!----OTHER LISTING ENDS--->

            

            

			<!----CREATION FORM STARTS---->

			<div class="tab-pane box" id="add" style="padding: 5px">

                <div class="box-content">

                    <?php echo form_open('doctor/manage_reporte/create/' , array('class' => 'form-horizontal validatable'));?>

                        <div class="padded">

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Tipo');?></label>

                                <div class="controls">

                                    <select name="type" class="uniform" style="width:100%;">

                                    	<option value="operation"><?php echo ('Operación');?></option>

                                    	<option value="birth"><?php echo ('Nacimiento');?></option>

                                    	<option value="death"><?php echo ('Muerte');?></option>

                                    	<option value="other"><?php echo ('Otro');?></option>

                                    </select>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Descripción');?></label>

                                <div class="controls">

                                    <input type="text" class="" name="description"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Fecha');?></label>

                                <div class="controls">

                                    <input type="text" class="datepicker fill-up" name="timestamp"/>

                                </div>

                            </div>

                            <div class="control-group">

                                <label class="control-label"><?php echo ('Doctor');?></label>

                                <div class="controls">

                                    <select class="chzn-select" name="doctor_id">

                                    		<option value="">Select</option>

										<?php 

										$doctors	=	$this->db->get('doctor')->result_array();

										foreach($doctors as $row2):

										?>

                                        	<option value="<?php echo $row2['doctor_id'];?>" ><?php echo $row2['name'];?></option>

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

                                    		<option value="">Select</option>

										<?php 

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

                        </div>

                        <div class="form-actions">

                            <button type="submit" class="btn btn-primary"><?php echo ('Agregar informe');?></button>

                        </div>

                    <?php echo form_close();?>                

                </div>                

			</div>

			<!----CREATION FORM ENDS--->

            

		</div>

	</div>

</div>