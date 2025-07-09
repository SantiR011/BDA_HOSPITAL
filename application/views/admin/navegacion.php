<div class="sidebar-background">
  <div class="primary-sidebar-background"></div>
</div>

<div class="primary-sidebar">
  <br />
  <div style="text-align:center;">
    <a href="<?php echo base_url(); ?>">
      <img src="<?php echo base_url(); ?>uploads/hmslg.png" />
    </a>
  </div>
  <br />

  <ul class="nav nav-collapse collapse nav-collapse-primary">

    <li class="<?php if ($page_name == 'dashboard')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/dashboard">
        <i class="icon-desktop icon-2x"></i>
        <span><?php echo ('Cuadro de mandos'); ?></span>
      </a>
    </li>

    <li class="<?php if ($page_name == 'gestionar_especialidad')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/gestionar_especialidad">
        <i class="icon-sitemap icon-2x"></i>
        <span><?php echo ('Especialidad'); ?></span>
      </a>
    </li>

    <!-- Submenú Médicos -->
    <li
      class="dark-nav <?php if ($page_name == 'gestionar_medico' || $page_name == 'ver_medico_desactivado')
        echo 'active'; ?>">
      <span class="glow"></span>
      <a class="accordion-toggle" data-toggle="collapse" href="#submenu_medico">
        <i class="icon-user-md icon-2x"></i>
        <span><?php echo ('Médicos'); ?> <i class="icon-caret-down"></i></span>
      </a>
      <ul id="submenu_medico"
        class="collapse <?php if ($page_name == 'gestionar_medico' || $page_name == 'ver_medico_desactivado')
          echo 'in'; ?>">
        <li class="<?php if ($page_name == 'gestionar_medico')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/gestionar_medico">
            <i class="icon-user-md"></i> <?php echo ('Gestionar Médicos'); ?>
          </a>
        </li>
        <li class="<?php if ($page_name == 'ver_medico_desactivado')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/ver_medico_desactivado">
            <i class="icon-eye-close"></i> <?php echo ('Ver Médicos desactivados'); ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Submenú Pacientes -->
    <li
      class="dark-nav <?php if ($page_name == 'gestionar_paciente' || $page_name == 'ver_paciente_desactivado')
        echo 'active'; ?>">
      <span class="glow"></span>
      <a class="accordion-toggle" data-toggle="collapse" href="#submenu_paciente">
        <i class="icon-user icon-2x"></i>
        <span><?php echo ('Pacientes'); ?> <i class="icon-caret-down"></i></span>
      </a>
      <ul id="submenu_paciente"
        class="collapse <?php if ($page_name == 'gestionar_paciente' || $page_name == 'ver_paciente_desactivado')
          echo 'in'; ?>">
        <li class="<?php if ($page_name == 'gestionar_paciente')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/gestionar_paciente">
            <i class="icon-user"></i> <?php echo ('Gestionar Pacientes'); ?>
          </a>
        </li>
        <li class="<?php if ($page_name == 'ver_paciente_desactivado')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/ver_paciente_desactivado">
            <i class="icon-eye-close"></i> <?php echo ('Ver Pacientes desactivados'); ?>
          </a>
        </li>
      </ul>
    </li>

    <!--Submenu Reportes-->
    <li
      class="dark-nav <?php if ($page_name == 'reporte_citas_medico' || $page_name == 'reportes_citas_paciente' || $page_name == 'reportes_citas_ausentes')
        echo 'active'; ?>">
      <span class="glow"></span>
      <a class="accordion-toggle" data-toggle="collapse" href="#submenu_reporte">
        <i class="icon-bar-chart icon-2x"></i>
        <span><?php echo ('Reportes'); ?> <i class="icon-caret-down"></i></span>
      </a>
      <ul id="submenu_reporte"
        class="collapse <?php if ($page_name == 'reporte_citas_medico' || $page_name == 'reportes_citas_paciente' || $page_name == 'reportes_citas_ausentes')
          echo 'in'; ?>">
        <li class="<?php if ($page_name == 'reporte_citas_medico')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_medico">
            <i class="icon-check"></i></i> <?php echo ('Reporte Citas Atendidas Medico'); ?>
          </a>
        </li>
        <li class="<?php if ($page_name == 'reportes_citas_paciente')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_paciente">
            <i class="icon-check"></i></i> <?php echo ('Reporte citas Paciente'); ?>
          </a>
        </li>
        <li class="<?php if ($page_name == 'reportes_citas_ausentes')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_ausentes">
            <i class="icon-remove"></i> <?php echo ('Reporte citas Ausentes'); ?>
          </a>
        </li>
      </ul>
    </li>


    <!-- Citas -->
    <li class="<?php if ($page_name == 'ver_cita')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/gestionar_cita">
        <i class="icon-time icon-2x"></i>
        <span><?php echo ('Ver Cita'); ?></span>
      </a>
    </li>

    <!-- Submenú Ajustes -->
    <li
      class="dark-nav <?php if ($page_name == 'gestionar_tablon_de_anuncios' || $page_name == 'system_settings')
        echo 'active'; ?>">
      <span class="glow"></span>
      <a class="accordion-toggle" data-toggle="collapse" href="#submenu_ajustes">
        <i class="icon-cogs icon-2x"></i>
        <span><?php echo ('Ajustes'); ?> <i class="icon-caret-down"></i></span>
      </a>
      <ul id="submenu_ajustes"
        class="collapse <?php if ($page_name == 'gestionar_tablon_de_anuncios' || $page_name == 'system_settings')
          echo 'in'; ?>">
        <li class="<?php if ($page_name == 'gestionar_tablon_de_anuncios')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/gestionar_tablon_de_anuncios">
            <i class="icon-columns"></i> <?php echo ('Gestionar el tablón de anuncios'); ?>
          </a>
        </li>
        <li class="<?php if ($page_name == 'system_settings')
          echo 'active'; ?>">
          <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
            <i class="icon-h-sign"></i> <?php echo ('Configuración del sistema'); ?>
          </a>
        </li>
      </ul>
    </li>

    <!-- Perfil -->
    <li class="<?php if ($page_name == 'gestionar_perfil')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/gestionar_perfil">
        <i class="icon-lock icon-2x"></i>
        <span><?php echo ('Perfil'); ?></span>
      </a>
    </li>

  </ul>
</div>