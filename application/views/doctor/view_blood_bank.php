<div class="box">

	<div class="box-header">

    

    	<!------CONTROL TABS START------->

		<ul class="nav nav-tabs nav-tabs-left">

			<li class="active">

            	<a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

					<?php echo ('Lista de Donantes de Sangre');?>

                    	</a></li>

			<li>

            	<a href="#list_blood_bank" data-toggle="tab"><i class="icon-align-justify"></i>

					<?php echo ('Banco de Sangre');?>

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

                    		<th><div><?php echo ('Nombre');?></div></th>

                    		<th><div><?php echo ('Edad');?></div></th>

                    		<th><div><?php echo ('Sexo');?></div></th>

                    		<th><div><?php echo ('Grupo Sanguíneo');?></div></th>

                    		<th><div><?php echo ('Última Fecha de Donación');?></div></th>

						</tr>

					</thead>

                    <tbody>

                    	<?php $count = 1;foreach($blood_donors as $row):?>

                        <tr>

                            <td><?php echo $count++;?></td>

							<td><?php echo $row['name'];?></td>

							<td><?php echo $row['age'];?></td>

							<td><?php echo $row['sex'];?></td>

							<td><?php echo $row['blood_group'];?></td>

							<td><?php echo date('d M,Y',$row['last_donation_timestamp']);?></td>

                        </tr>

                        <?php endforeach;?>

                    </tbody>

                </table>

			</div>

            <!----TABLE LISTING ENDS--->

            

            

			<!----CREATION FORM STARTS---->

			<div class="tab-pane box" id="list_blood_bank" >

                <div class="box-content">

                    <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                        <thead>

                            <tr>

                                <th><div>#</div></th>

                                <th><div><?php echo ('Grupo Sanguíneo');?></div></th>

                                <th><div><?php echo ('Estado');?></div></th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php $count = 1;foreach($blood_bank as $row):?>

                            <tr>

                                <td><?php echo $count++;?></td>

                                <td><?php echo $row['blood_group'];?></td>

                                <td><?php echo $row['status'];?></td>

                            </tr>

                            <?php endforeach;?>

                        </tbody>

                    </table>  

                </div>                

			</div>

			<!----CREATION FORM ENDS--->

            

		</div>

	</div>

</div>
