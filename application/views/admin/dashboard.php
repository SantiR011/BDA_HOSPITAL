<div class="container-fluid padded">

    <div class="row-fluid">
        <div class="span30">

            <!-- Menú de navegación principal con botones grandes -->
            <div class="action-nav-normal">

                <!-- Fila con botones: Doctor, Paciente, Cita -->
                <div class="row-fluid">
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/gestionar_medico">
                            <i class="icon-user-md"></i>
                            <span><?php echo ('Doctor'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/gestionar_paciente">
                            <i class="icon-user"></i>
                            <span><?php echo ('Paciente'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/gestionar_cita">
                            <i class="icon-exchange"></i>
                            <span><?php echo ('Cita'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_medico">
                            <i class="icon-exchange"></i>
                            <span><?php echo ('Ver Reporte Citas Medico'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_paciente/paciente">
                            <i class="icon-exchange"></i>
                            <span><?php echo ('Ver Reporte Citas Paciente'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_ausentes/citas">
                            <i class="icon-exchange"></i>
                            <span><?php echo ('Ver Reporte Citas Ausentes'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/ver_medico_desactivado">
                            <i class="icon-exchange"></i>
                            <span><?php echo ('Ver medicos desactivados'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/ver_paciente_desactivado">
                            <i class="icon-exchange"></i>
                            <span><?php echo ('Ver pacientes desactivados'); ?></span>
                        </a>
                    </div>

                </div>

                <!-- Fila con botones: Informe de nacimiento, Tablón de anuncios -->
                <div class="row-fluid">
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/reporte">
                            <i class="icon-github-alt"></i>
                            <span><?php echo ('Reportes'); ?></span>
                        </a>
                    </div>

                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/gestionar_tablon_de_anuncios">
                            <i class="icon-columns"></i>
                            <span><?php echo ('Tablón de anuncios'); ?></span>
                        </a>
                    </div>
                    <div class="span2 action-nav-button">
                        <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                            <i class="icon-h-sign"></i>
                            <span><?php echo ('Ajustes'); ?></span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Fin del menú del dashboard -->
        </div>

        <hr />

        <div class="row-fluid">
            <!-- INICIO: Calendario de programación -->
            <div class="span6">
                <div class="box">
                    <div class="box-header">
                        <div class="title">
                            <i class="icon-calendar"></i> <?php echo ('Calendario'); ?>
                        </div>
                    </div>
                    <div class="box-content">
                        <div id="schedule_calendar"></div>
                    </div>
                </div>
            </div>
            <!-- FIN: Calendario de programación -->

            <!-- INICIO: Lista del tablón de anuncios -->
            <div class="span6">
                <div class="box">
                    <div class="box-header">
                        <span class="title">
                            <i class="icon-reorder"></i> <?php echo ('Tablón de anuncios'); ?>
                        </span>
                    </div>
                    <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                        <?php
                        // Obtener los avisos ordenados por fecha de creación descendente
                        $this->db->order_by('crear_timestamp', 'desc');
                        $notices = $this->db->get('anuncios')->result_array();

                        foreach ($notices as $row): ?>
                            <div class="box-section news with-icons">
                                <div class="avatar blue">
                                    <i class="icon-tag icon-2x"></i>
                                </div>

                                <div class="news-time">
                                    <span><?php echo date('d', $row['crear_timestamp']); ?></span>
                                    <?php echo date('M', $row['crear_timestamp']); ?>
                                </div>

                                <div class="news-content">
                                    <div class="news-title">
                                        <?php echo $row['noticia_titulo']; ?>
                                    </div>
                                    <div class="news-text">
                                        <?php echo $row['noticia']; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>
                </div>
            </div>
            <!-- FIN: Lista del tablón de anuncios -->

        </div>

    </div>

    <!-- Script para inicializar el calendario -->
    <script>
        $(document).ready(function () {
            // Inicializar el calendario usando fullCalendar
            $("#schedule_calendar").fullCalendar({
                header: {
                    left: "prev,next",
                    center: "title",
                    right: "month,agendaWeek,agendaDay"
                },
                editable: false,
                droppable: false,
                events: [
                    <?php
                    // Insertar eventos al calendario desde la tabla de avisos
                    $notices = $this->db->get('anuncios')->result_array();
                    foreach ($notices as $row): ?>
                            {
                            title: "<?php echo $row['noticia_titulo']; ?>",
                            start: new Date(<?php echo date('Y', $row['crear_timestamp']); ?>, <?php echo date('m', $row['crear_timestamp']) - 1; ?>, <?php echo date('d', $row['crear_timestamp']); ?>),
                            end: new Date(<?php echo date('Y', $row['crear_timestamp']); ?>, <?php echo date('m', $row['crear_timestamp']) - 1; ?>, <?php echo date('d', $row['crear_timestamp']); ?>)
                        },
                    <?php endforeach; ?>
                ]
            });
        });
    </script>