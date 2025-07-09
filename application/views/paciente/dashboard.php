<div class="container-fluid padded">

    <div class="row-fluid">

        <div class="span30">

            <!-- find me in partials/action_nav_normal -->

            <!--big normal buttons-->

            <div class="action-nav-normal">

                <div class="row-fluid">

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?paciente/ver_medico">

                            <i class="icon-stethoscope"></i>

                            <span><?php echo ('Medico'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?paciente/gestionar_cita">

                            <i class="icon-exchange"></i>

                            <span><?php echo ('Cita'); ?></span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!---DASHBOARD MENU BAR ENDS HERE-->

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
<pre>
<?php print_r($citas); ?>
</pre>

<!-- Script para inicializar el calendario -->
<script>
    $(document).ready(function () {
        $("#schedule_calendar").fullCalendar({
            header: {
                left: "prev,next",
                center: "title",
                right: "month,agendaWeek,agendaDay"
            },
            defaultView: "month",
            editable: false,
            droppable: false,
            slotDuration: '00:15:00',
            minTime: '07:00:00',
            maxTime: '20:00:00',
            allDaySlot: false, // ¡IMPORTANTE! Desactiva los slots de todo el día
            events: [
                <?php foreach ($citas as $cita): ?>
        {
                        title: "Cita con el Dr. <?php echo $cita['medico_nombre'] . ' ' . $cita['medico_apellido']; ?>",
                        start: "<?php echo $cita['fecha_hora']; ?>",
                        end: "<?php echo date('Y-m-d\TH:i:s', strtotime($cita['fecha_hora'] . ' +30 minutes')); ?>",
                        color: "#007bff"
                    },
                <?php endforeach; ?>
            ]

        });
    });
</script>