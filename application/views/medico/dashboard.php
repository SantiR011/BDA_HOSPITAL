<div class="container-fluid padded">

	<div class="row-fluid">

        <div class="span30">

            <!-- find me in partials/action_nav_normal -->

            <!--big normal buttons-->

            <div class="action-nav-normal">

                <div class="row-fluid">

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url();?>index.php?medico/gestionar_paciente">

                        <i class="icon-user"></i>

                        <span><?php echo ('Paciente');?></span>

                        </a>

                    </div>

                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url();?>index.php?medico/gestionar_cita">

                        <i class="icon-exchange"></i>

                        <span><?php echo ('Citas');?></span>

                        </a>

                    </div>


                    <div class="span2 action-nav-button">

                        <a href="<?php echo base_url();?>index.php?medico/gestionar_informe">

                        <i class="icon-hospital"></i>

                        <span><?php echo ('Gestionar informe');?></span>

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

                        <i class="icon-calendar"></i> <?php echo ('Calendario');?>

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

                        <i class="icon-reorder"></i> <?php echo ('Tablón de anuncios');?>

                    </span>

                </div>

                <div class="box-content scrollable" style="max-height: 500px; overflow-y: auto">

                

                    <?php 

                    $notices	=	$this->db->get('anuncios')->result_array();

                    foreach($notices as $row):

                    ?>

                    <div class="box-section news with-icons">

                        <div class="avatar blue">

                            <i class="icon-tag icon-2x"></i>

                        </div>

                        <div class="news-time">

                            <span><?php echo date('d',$row['crear_timestamp']);?></span> <?php echo date('M',$row['crear_timestamp']);?>

                        </div>

                        <div class="news-content">

                            <div class="news-title">

                                <?php echo $row['noticia_titulo'];?>

                            </div>

                            <div class="news-text">

                                 <?php echo $row['noticia'];?>

                            </div>

                        </div>

                    </div>

                    <?php endforeach;?>

                </div>

            </div>

        </div>

    	<!-----NOTICEBOARD LIST ENDS-->

    </div>

</div>



  

  <script>

  $(document).ready(function() {



    // page is now ready, initialize the calendar...



    $("#schedule_calendar").fullCalendar({

            header: {

                left: 	"prev,next",

                center: "title",

                right: 	"month,agendaWeek,agendaDay"

            },

            editable: 0,

            droppable: 0,

            events: [

					<?php 

                    $citas	=	$this->db->get_where('cita' , array('numero_id' => $this->session->userdata('numero_id')))->result_array();

                    foreach($citas as $row):

                    ?>

					{

						title: "<?php echo ('Appointment').' : '.$this->crud_model->get_type_name_by_id('paciente' ,$row['numero_id'], 'name' );?>",

						start: new Date(<?php echo date('Y',$row['cita_timestamp']);?>, <?php echo date('m',$row['cita_timestamp'])-1;?>, <?php echo date('d',$row['cita_timestamp']);?>),

						end:	new Date(<?php echo date('Y',$row['cita_timestamp']);?>, <?php echo date('m',$row['cita_timestamp'])-1;?>, <?php echo date('d',$row['cita_timestamp']);?>)  

            		},

					<?php

					endforeach;

					?>

					]

        })



});

  </script>