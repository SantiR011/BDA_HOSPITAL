<div class="container-fluid padded">

    <div class="row-fluid">

        <div class="span30">

            <!-- find me in partials/action_nav_normal -->

            <!--big normal buttons-->

            <div class="action-nav-normal">

                <div class="row-fluid">

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/manage_doctor">

                            <i class="icon-user-md"></i>

                            <span><?php echo ('Doctor'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/manage_paciente">

                            <i class="icon-user"></i>

                            <span><?php echo ('Paciente'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/manage_medico">

                            <i class="icon-plus-sign-alt"></i>

                            <span><?php echo ('Enfermera'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_cita">

                            <i class="icon-exchange"></i>

                            <span><?php echo ('Cita'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_payment">

                            <i class="icon-credit-card"></i>

                            <span><?php echo ('Pago'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_blood_bank">

                            <i class="icon-tint"></i>

                            <span><?php echo ('Banco de sangre'); ?></span>

                        </a>

                    </div>


                </div>

                <div class="row-fluid">

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_medicamento">

                            <i class="icon-medkit"></i>

                            <span><?php echo ('Medicina'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_reporte/operation">

                            <i class="icon-reorder"></i>

                            <span><?php echo ('Informe de la operación'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_reporte/birth">

                            <i class="icon-github-alt"></i>

                            <span><?php echo ('Informe de nacimiento'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_reporte/death">

                            <i class="icon-minus-sign"></i>

                            <span><?php echo ('Informe de fallecimiento'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/view_bed_status">

                            <i class="icon-hdd"></i>

                            <span><?php echo ('Asignación de camas'); ?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/manage_anuncios">

                            <i class="icon-columns"></i>

                            <span><?php echo ('Tablón de anuncios'); ?></span>

                        </a>

                    </div>



                </div>

                <div class="row-fluid">







                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/system_settings">

                            <i class="icon-h-sign"></i>

                            <span><?php echo ('Ajustes'); ?></span>

                        </a>

                    </div>


                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url(); ?>index.php?admin/backup_restore">

                            <i class="icon-download-alt"></i>

                            <span><?php echo ('Copia de seguridad'); ?></span>

                        </a>

                    </div>

                </div>

            </div>

        </div>

        <!---DASHBOARD MENU BAR ENDS HERE-->

    </div>

    <hr />

    <div class="row-fluid">



        <!-----CALENDAR SCHEDULE STARTS-->

        <div class="span6">

            <div class="box">

                <div class="box-header">

                    <div class="title">

                        <i class="icon-calendar"></i> <?php echo ('Calendario'); ?>

                    </div>

                </div>

                <div class="box-content">

                    <div id="schedule_calendar">

                    </div>

                </div>

            </div>

        </div>

        <!-----CALENDAR SCHEDULE ENDS-->



        <!-----NOTICEBOARD LIST STARTS-->

        <div class="span6">

            <div class="box">

                <div class="box-header">

                    <span class="title">

                        <i class="icon-reorder"></i> <?php echo ('Tablón de anuncios'); ?>

                    </span>

                </div>

                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">



                    <?php

                    $this->db->order_by('create_timestamp', 'desc');

                    $notices = $this->db->get('anuncios')->result_array();

                    foreach ($notices as $row):

                        ?>

                        <div class="box-section news with-icons">

                            <div class="avatar blue">

                                <i class="icon-tag icon-2x"></i>

                            </div>

                            <div class="news-time">

                                <span><?php echo date('d', $row['create_timestamp']); ?></span>
                                <?php echo date('M', $row['create_timestamp']); ?>

                            </div>

                            <div class="news-content">

                                <div class="news-title">

                                    <?php echo $row['notice_title']; ?>

                                </div>

                                <div class="news-text">

                                    <?php echo $row['notice']; ?>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; ?>

                </div>

            </div>

        </div>

        <!-----NOTICEBOARD LIST ENDS-->

    </div>

</div>







<script>

    $(document).ready(function () {



        // page is now ready, initialize the calendar...



        $("#schedule_calendar").fullCalendar({

            header: {

                left: "prev,next",

                center: "title",

                right: "month,agendaWeek,agendaDay"

            },

            editable: 0,

            droppable: 0,

            events: [

                <?php



                $notices = $this->db->get('anuncios')->result_array();

                foreach ($notices as $row):

                    ?>

                        {

                        title: "<?php echo $row['notice_title']; ?>",

                        start: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>),

                        end: new Date(<?php echo date('Y', $row['create_timestamp']); ?>, <?php echo date('m', $row['create_timestamp']) - 1; ?>, <?php echo date('d', $row['create_timestamp']); ?>)

                    },

                    <?php

                endforeach;

                ?>

            ]

        })



    });

</script>