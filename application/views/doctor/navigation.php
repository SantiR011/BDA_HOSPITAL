<div class="sidebar-background">

	<div class="primary-sidebar-background">

	</div>

</div>

<div class="primary-sidebar">

	<!-- Main nav -->

    <br />

    <div style="text-align:center;">

    	<a href="<?php echo base_url();?>">

        	<img src="<?php echo base_url();?>uploads/hmslg.png"  style="max-height:100px; max-width:100px;"/>

        </a>

    </div>

   	<br />

	<ul class="nav nav-collapse collapse nav-collapse-primary">

    

        

        <!------dashboard----->

		<li class="<?php if($page_name == 'dashboard')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/dashboard" >

					<i class="icon-desktop icon-2x"></i>

					<span><?php echo ('Panel');?></span>

				</a>

		</li>

        

        <!------paciente----->

		<li class="<?php if($page_name == 'manage_paciente')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/manage_paciente" >

					<i class="icon-user icon-2x"></i>

					<span><?php echo ('Paciente');?></span>

				</a>

		</li>

        

        <!------cita----->

		<li class="<?php if($page_name == 'manage_cita')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/manage_cita" >

					<i class="icon-edit icon-2x"></i>

					<span><?php echo ('Administrar cita');?></span>

				</a>

		</li>

        

        <!------prescripcion----->

		<li class="<?php if($page_name == 'manage_prescripcion')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/manage_prescripcion" >

					<i class="icon-stethoscope icon-2x"></i>

					<span><?php echo ('Administrar prescripción');?></span>

				</a>

		</li>

        

        <!------bed allotment----->

		<li class="<?php if($page_name == 'manage_bed_allotment')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/manage_bed_allotment" >

					<i class="icon-hdd icon-2x"></i>

					<span><?php echo ('Asignación de camas');?></span>

				</a>

		</li>

        

        <!------blood bank----->

		<li class="<?php if($page_name == 'view_blood_bank')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/view_blood_bank" >

					<i class="icon-tint icon-2x"></i>

					<span><?php echo ('Ver Banco de Sangre');?></span>

				</a>

		</li>



		

		<!------manage reporte--->

		<li class="<?php if($page_name == 'manage_reporte')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/manage_reporte" >

					<i class="icon-hospital icon-2x"></i>

					<span><?php echo ('Administrar informe');?></span>

				</a>

		</li>



		<!------manage own profile--->

		<li class="<?php if($page_name == 'manage_profile')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?doctor/manage_profile" >

					<i class="icon-lock icon-2x"></i>

					<span><?php echo ('Perfil');?></span>

				</a>

		</li>

		

	</ul>

	

</div>