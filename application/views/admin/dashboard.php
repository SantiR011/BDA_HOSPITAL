<div class="container-fluid padded">

    <div class="row-fluid">
        <div class="span30">

            <!-- Menú de navegación principal con botones grandes -->
            <style>
                .action-nav-button {
                    text-align: center;
                    padding: 20px;
                    background: #f5f5f5;
                    border-radius: 10px;
                    margin-bottom: 20px;
                    transition: all 0.3s ease-in-out;
                }

                .action-nav-button:hover {
                    background: #e0e0e0;
                }

                .action-nav-button i {
                    font-size: 32px;
                    margin-bottom: 10px;
                }
            </style>

            <div class="row-fluid">
                <!-- Fila 1 -->
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_medico">
                        <i class="icon-user-md"></i><br>
                        <span>Medicos</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/ver_medico_desactivado">
                        <i class="icon-eye-close"></i><br>
                        <span>Medicos Desactivados</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_paciente">
                        <i class="icon-user"></i><br>
                        <span>Pacientes</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/ver_paciente_desactivado">
                        <i class="icon-eye-close"></i><br>
                        <span>Pacientes Desactivados</span>
                    </a>
                </div>

                <!-- Fila 2 -->
                 <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_cita">
                        <i class="icon-time"></i><br>
                        <span>Citas</span>
                    </a>
                </div>
                
                 <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_especialidad">
                        <i class="icon-tags icon-2x"></i><br>
                        <span>Especialidades</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/gestionar_tablon_de_anuncios">
                        <i class="icon-columns"></i><br>
                        <span>Tablón de Anuncios</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/system_settings">
                        <i class="icon-cogs"></i><br>
                        <span>Ajustes</span>
                    </a>
                </div>

                <!-- Fila 3 -->
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_medico">
                        <i class="icon-check icon-2x"></i><br>
                        <span>Reporte Citas Atendidas Médico</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_paciente/paciente">
                        <i class="icon-check icon-2x"></i><br>
                        <span>Reporte Citas Pacientes</span>
                    </a>
                </div>
                <div class="span3 action-nav-button">
                    <a href="<?php echo base_url(); ?>index.php?admin/reporte_citas_ausentes/citas">
                        <i class="icon-remove icon-2x"></i><br>
                        <span>Reporte Citas Ausentes</span>
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