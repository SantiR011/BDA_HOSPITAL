<div class="sidebar-background">

	<div class="primary-sidebar-background">

	</div>

</div>

<div class="primary-sidebar">

	<!-- Main nav -->

    <br />

    <div style="text-align:center;">

    	<a href="<?php echo base_url();?>">

        	<img src="<?php echo base_url();?>uploads/hmslg.png" />

        </a>

    </div>

   	<br />

	<ul class="nav nav-collapse collapse nav-collapse-primary">

    

        

        <!------dashboard----->

		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?admin/dashboard" >

					<i class="icon-desktop icon-2x"></i>

					<span><?php echo ('Cuadro de mandos');?></span>

				</a>

		</li>

        

        <!------especialidad----->

		<li class="<?php if($page_name == 'manage_especialidad')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?admin/manage_especialidad" >

					<i class="icon-sitemap icon-2x"></i>

					<span><?php echo ('Departamento');?></span>

				</a>

		</li>

        

        <!------doctor----->

		<li class="<?php if($page_name == 'manage_doctor')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?admin/manage_doctor" >

					<i class="icon-user-md icon-2x"></i>

					<span><?php echo ('Doctor');?></span>

				</a>

		</li>

        

        <!------paciente----->

		<li class="<?php if($page_name == 'manage_paciente')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?admin/manage_paciente" >

					<i class="icon-user icon-2x"></i>

					<span><?php echo ('Paciente');?></span>

				</a>

		</li>

        

        <!------medico----->

		<li class="<?php if($page_name == 'manage_medico')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?admin/manage_medico" >

					<i class="icon-plus-sign-alt icon-2x"></i>

					<span><?php echo ('Enfermera');?></span>

				</a>

		</li>
        
        

		<!------manage hospital------>

		<li class="dark-nav <?php if(	$page_name == 'view_cita' 	|| 

										$page_name == 'view_payment' 		|| 

										$page_name == 'view_bed_status' 	|| 

										$page_name == 'view_blood_bank' 	|| 

										$page_name == 'view_medicamento' 		|| 

										$page_name == 'view_reporte'  )echo 'active';?>">

			<span class="glow"></span>

            <a class="accordion-toggle  " data-toggle="collapse" href="#view_hospital_submenu" >

                <i class="icon-screenshot icon-2x"></i>

                <span><?php echo ('Monitor Hospital');?><i class="icon-caret-down"></i></span>

            </a>

            

            <ul id="view_hospital_submenu" class="collapse <?php if(	$page_name == 'view_cita' 	|| 

																		$page_name == 'view_payment' 		|| 

																		$page_name == 'view_bed_status' 	|| 

																		$page_name == 'view_blood_bank' 	|| 

																		$page_name == 'view_medicamento' 		|| 

																		$page_name == 'view_reporte'  )echo 'in';?>">

                <li class="<?php if($page_name == 'view_cita')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_cita">

                      <i class="icon-exchange"></i> <?php echo ('Ver cita');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_payment')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_payment">

                      <i class="icon-money"></i> <?php echo ('Ver pago');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_bed_status')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_bed_status">

                      <i class="icon-hdd"></i> <?php echo ('Ver el estado de las camas');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_blood_bank')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_blood_bank">

                      <i class="icon-tint"></i> <?php echo ('Ver Banco de Sangre');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_medicamento')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_medicamento">

                      <i class="icon-medkit"></i> <?php echo ('Ver Medicina');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_reporte' && $reporte_type	==	'operation')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_reporte/operation">

                      <i class="icon-reorder"></i> <?php echo ('Ver Operación');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_reporte' && $reporte_type	==	'birth')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_reporte/birth">

                      <i class="icon-github-alt"></i> <?php echo ('Ver el informe de nacimiento');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'view_reporte' && $reporte_type	==	'death')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/view_reporte/death">

                      <i class="icon-user"></i> <?php echo ('Ver el informe de fallecimientos');?>

                  </a>

                </li>

            </ul>

		</li>

        

        

        <!------system settings------>

		<li class="dark-nav <?php if(	$page_name == 'manage_email_template' 	|| 

										$page_name == 'manage_anuncios' 		||

										$page_name == 'system_settings' 		|| 

										$page_name == 'manage_language' 		|| 

										$page_name == 'backup_restore' )echo 'active';?>">

			<span class="glow"></span>

            <a class="accordion-toggle  " data-toggle="collapse" href="#settings_submenu" >

                <i class="icon-wrench icon-2x"></i>

                <span><?php echo ('Ajustes');?><i class="icon-caret-down"></i></span>

            </a>

            

            <ul id="settings_submenu" class="collapse <?php if(	$page_name == 'manage_email_template' 	|| 

																$page_name == 'manage_anuncios' 		||

																$page_name == 'system_settings' 		|| 

																$page_name == 'manage_language' 		|| 

																$page_name == 'backup_restore' )echo 'in';?>">

                <!--<li class="<?php if($page_name == 'manage_email_template')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/manage_email_template">

                      <i class="icon-envelope"></i> <?php echo ('Gestionar plantilla de correo electrónico');?>

                  </a>

                </li>-->

                <li class="<?php if($page_name == 'manage_anuncios')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/manage_anuncios">

                      <i class="icon-columns"></i> <?php echo ('Gestionar el tablón de anuncios');?>

                  </a>

                </li>

                <li class="<?php if($page_name == 'system_settings')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/system_settings">

                      <i class="icon-h-sign"></i> <?php echo ('Configuración del sistema');?>

                  </a>

                </li>


                <li class="<?php if($page_name == 'backup_restore')echo 'active';?>">

                  <a href="<?php echo base_url();?>index.php?admin/backup_restore">

                      <i class="icon-download-alt"></i> <?php echo ('Restaurar copia de seguridad');?>

                  </a>

                </li>

            </ul>

		</li>



		<!------manage own profile--->

		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?admin/manage_profile" >

					<i class="icon-lock icon-2x"></i>

					<span><?php echo ('Perfil');?></span>

				</a>

		</li>

		

	</ul>

	

</div>