<div class="box">

    <div class="box-header">

        <!------CONTROL TABS START------->

        <ul class="nav nav-tabs nav-tabs-left">

            <li class="active">

                <a href="#list" data-toggle="tab"><i class="icon-align-justify"></i> 

                    <?php echo ('Ver Medicamento');?>

                </a></li>

        </ul>

        <!------CONTROL TABS END------->

    </div>

    <div class="box-content padded">

        <div class="tab-content">            

            <!----TABLE LISTING STARTS--->

            <div class="tab-pane box active" id="list">

                <table cellpadding="0" cellspacing="0" border="0" class="dTable responsive table-hover">

                    <thead>

                        <tr>

                            <th><div>#</div></th>

                            <th><div><?php echo ('Nombre');?></div></th>

                            <th><div><?php echo ('Categoría');?></div></th>

                            <th><div><?php echo ('Descripción');?></div></th>

                            <th><div><?php echo ('Precio');?></div></th>

                            <th><div><?php echo ('Compañía Fabricante');?></div></th>

                        </tr>

                    </thead>

                    <tbody>

                        <?php 

                        $count = 1;

                        foreach($medicamentos as $row):

                            ?>

                            <tr>

                                <td><?php echo $count++;?></td>

                                <td><?php echo $row['name'];?></td>

                                <td><?php echo $this->crud_model->get_type_name_by_id('medicamento_category',$row['medicamento_category_id'],'name');?></td>

                                <td><?php echo $row['description'];?></td>

                                <td><?php echo $row['price'];?></td>

                                <td><?php echo $row['manufacturing_company'];?></td>

                            </tr>

                            <?php 

                        endforeach;

                        ?>

                    </tbody>

                </table>

            </div>

            <!----TABLE LISTING ENDS--->

        </div>

    </div>

</div>
