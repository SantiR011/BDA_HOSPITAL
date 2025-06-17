<div class="box">

	<div class="box-header">

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

			<li class="active">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Ver Cita');?>

                    	</a></li>

		</ul>

    	<!------CONTROL TABS END------->

	</div>

	<div class="box-content padded">

		<div class="tab-content">            

            <!----TABLE LISTING STARTS--->

            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                	<thead>

                		<tr>

                    		<th><div>#</div></th>

                    		<th><div><?php echo ('Hora');?></div></th>

                    		<th><div><?php echo ('Médico');?></div></th>

                    		<th><div><?php echo ('Paciente');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php 

						$count = 1;

						foreach($citas as $row):

							?>

							<tr>

								<td><?php echo $count++;?></td>

								<td><?php echo date('d M,Y',$row['cita_timestamp']);?></td>

                                <td><?php echo $this->crud_model->get_type_name_by_id('doctor',$row['doctor_id'],'name');?></td>

                                <td><?php echo $this->crud_model->get_type_name_by_id('paciente',$row['paciente_id'],'name');?></td>

							</tr>

							<?php 

						endforeach;

						?>

                    </tbody>

                </table>

			</div>

            <!----TABLE LISTING ENDS--->

		</div>

	</div>

</div>
