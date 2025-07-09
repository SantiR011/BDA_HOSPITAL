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

				<a href="<?php echo base_url();?>index.php?medico/dashboard" >

					<i class="icon-desktop icon-2x"></i>

					<span><?php echo ('Panel');?></span>

				</a>

		</li>

        

        <!------paciente----->

		<li class="<?php if($page_name == 'gestionar_paciente')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?medico/gestionar_paciente" >

					<i class="icon-user icon-2x"></i>

					<span><?php echo ('Paciente');?></span>

				</a>

		</li>

        

        <!------cita----->

		<li class="<?php if($page_name == 'gestionar_cita')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?medico/gestionar_cita" >

					<i class="icon-edit icon-2x"></i>

					<span><?php echo ('Citas');?></span>

				</a>

		</li>



		<!------manage own profile--->

		<li class="<?php if($page_name == 'gestionar_perfil')echo 'dark-nav active';?>">

			<span class="glow"></span>

				<a href="<?php echo base_url();?>index.php?medico/gestionar_perfil" >

					<i class="icon-lock icon-2x"></i>

					<span><?php echo ('Perfil');?></span>

				</a>

		</li>

		

	</ul>

	

</div>