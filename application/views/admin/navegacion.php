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

    <li class="<?php if ($page_name == 'gestionar_medico')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/gestionar_medico">
        <i class="icon-user-md icon-2x"></i>
        <span><?php echo ('Médico'); ?></span>
      </a>
    </li>

    <li class="<?php if ($page_name == 'gestionar_paciente')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/gestionar_paciente">
        <i class="icon-user icon-2x"></i>
        <span><?php echo ('Paciente'); ?></span>
      </a>
    </li>

    <li class="<?php if ($page_name == 'ver_cita')
      echo 'dark-nav active'; ?>">
      <span class="glow"></span>
      <a href="<?php echo base_url(); ?>index.php?admin/gestionar_cita">
        <i class="icon-exchange icon-2x"></i>
        <span><?php echo ('Ver Cita'); ?></span>
      </a>
    </li>

    <li class="dark-nav <?php if (
      $page_name == 'manage_email_template' ||
      $page_name == 'gestionar_tablon_de_anuncios' ||
      $page_name == 'system_settings' ||
      $page_name == 'manage_language' ||
      $page_name == 'backup_restore'
    )
      echo 'active'; ?>">
      <span class="glow"></span>
      <a class="accordion-toggle" data-toggle="collapse" href="#settings_submenu">
        <i class="icon-wrench icon-2x"></i>
        <span><?php echo ('Ajustes'); ?><i class="icon-caret-down"></i></span>
      </a>

      <ul id="settings_submenu" class="collapse <?php if (
        $page_name == 'manage_email_template' ||
        $page_name == 'gestionar_tablon_de_anuncios' ||
        $page_name == 'system_settings' ||
        $page_name == 'manage_language' ||
        $page_name == 'backup_restore'
      )
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