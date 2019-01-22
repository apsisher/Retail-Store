<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="pull pull-right">
                <a href="<?php echo base_url('order_list/create_new_order'); ?>"  class="btn btn-primary btn-flat btn-lg" ><i class="fa fa-plus-square" aria-hidden="true"></i>  Create Order
                </a>
                <button onclick="printDiv('print-section')" class="btn btn-default btn-lg btn-flat   pull-right "><i class="fa fa-print  pull-left"></i> Print Report</button>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box" id="print-section">
                <div class="box-header">
                    <h3 class="box-title"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> Salesman Pre Sale Orders</h3>
                    <br>
                    <small>By default it will fetch the orders of current month.  </small>
                </div>
                <div class="box-body">
                    <div class="row">
                        <?php
                            $attributes = array('id'=>'supply_form','method'=>'post',);
                        ?>
                        <?php echo form_open('order_list',$attributes); ?>
                        <div class="col-md-12 ">
                            <div class="form-group margin ">
                                <?php echo form_label('Date From:'); ?>
                                <div class="input-group date ">
                                    <div class="input-group-addon   ">
                                        <i class="fa fa-calendar "></i>
                                    </div>
                                    <?php
                                        $data = array('class'=>'form-control  input-lg','type'=>'date','id'=>'datepicker','name'=>'date1','placeholder'=>'e.g 12-08-2018','reqiured'=>'');
                                        echo form_input($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group margin">
                                <?php echo form_label('Date To:'); ?>
                                    <div class="input-group date">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <?php
                                            $data = array('class'=>'form-control  input-lg' ,'type'=>'date','id'=>'datepicker','name'=>'date2','placeholder'=>'e.g 12-08-2018','reqiured'=>'');
                                            echo form_input($data);
                                        ?>
                                    </div>
                            </div>
                        </div>
                            <div class="col-md-12">
                                <?php
                                    $data = array('class'=>'btn btn-info btn-lg btn-flat margin  pull-right','type' => 'submit','name'=>'searchecord','value'=>'true', 'content' => '<i class="fa fa-search" aria-hidden="true"></i> Search Orders');
                                    echo form_button($data);
                                 ?>
                            </div>
                            <?php echo form_close(); ?>
                    </div>
                    <div class="col-md-12 table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <?php
                                    foreach ($table_heading_names_of_coloums as $table_head)
                                    {
                                    ?>
                                        <th>
                                            <?php echo $table_head; ?>
                                        </th>
                                    <?php
                                    }
                                    ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if($order_list != NULL)
                                {
                                    $counter = 1;
                                    
                                    foreach ($order_list as $single_order)
                                    {
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $counter++; ?>
                                        </td>
                                        <td>
                                            <?php echo $single_order->add_date; ?>
                                        </td>
                                        <td>
                                            <?php echo $single_order->salesman_name; ?>
                                        </td> 
                                        <td>
                                            <?php echo $single_order->agent_name; ?>
                                        </td>
                                        <td>
                                            <div class="btn-group pull no-print pull-right">
                                                <button type="button" class="btn btn-info btn-flat">Action</button>
                                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                                    <span class="caret"></span>
                                                    <span class="sr-only">Toggle Dropdown</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    <li>
                                                        <a href="<?php echo base_url('order_list/generate_orderlist/'.$single_order->add_date.'/'.$single_order->salesman_id); ?>" >
                                                             <i class="fa fa-pencil"></i> Generate order list
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                        }
                                    }
                                     ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</section>
<!-- Bootstrap model  -->
<?php $this->load->view('bootstrap_model.php'); ?>
<!-- Bootstrap model  ends--> 
