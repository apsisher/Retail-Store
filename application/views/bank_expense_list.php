<section class="content-header">
    <div class="row">
        <div class="col-md-12">
            <div class="pull pull-right">
               <button type="button" onclick="show_modal_page('<?php echo base_url();?>expense/popup/add_bank_expense_model')" class="btn btn-info btn-flat"><i class="fa fa-plus-square" aria-hidden="true"></i>
                Add Expense
                </button>
                <button onclick="printDiv('print-section')" class="btn btn-default btn-flat pull-right "><i class="fa fa-print pull-left"></i> Print / Pdf</button>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="row">
        <div class="box " id="print-section">
            <div class="box-header">
                <h3 class="box-title"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i> <?php echo $table_name; ?></h3>
            </div>
            <div class="box-body">
                <?php
                    $attributes = array('id'=>'bank_expense','method'=>'post','class'=>'');
                ?>
                <?php echo form_open('expense/bank_expense',$attributes); ?>
                <div class="row no-print">
                    <div class="col-md-3 ">
                        <div class="form-group">
                            <label for="date_from" class="col-sm-5 control-label">
                                Date From
                            </label>
                            <div class="col-sm-7">
                                <?php 
                                    $data = array('class'=>'form-control','id'=>'date_from','type'=>'date','name'=>'date1');
                                    echo form_input($data); 
                                ?>
                            </div>   
                        </div>
                    </div> 
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date_from" class="col-sm-4 control-label">
                                Date To
                            </label>
                            <div class="col-sm-8">
                                <?php 
                                     $data1 = array('class'=>'form-control','type'=>'date','name'=>'date2');
                                    echo form_input($data1);
                                ?>
                            </div>   
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <?php
                                $data = array('class'=>'btn btn-info','type' => 'submit','name'=>'btnSubmit','value'=>'true', 'content' => '<i class="fa fa-search" aria-hidden="true"></i> Search expense');
                                echo form_button($data);
                            ?>
                        </div>
                    </div>
                </div>
             <?php echo form_close(); ?> 
             <div class="col-md-12 table-responsive">
                <table id="" class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <?php
    					foreach ($table_heading_names_of_coloums as $table_head)
                        {
        				?>
                            <td>
                                <?php echo $table_head; ?>
                            </td>
                        <?php
        				}
        				 ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
        				if($expense_record_list != NULL)
                        {
                            $counter = 1;
                            $total_bill = 0;
        					foreach ($expense_record_list as $single_expense)
                            {
                                 $total_bill =  $total_bill + $single_expense->total_bill;
        				?>
                        <tr >
                            <td>
                                <?php echo $counter; ?>
                            </td>
                            <td>
                                <?php echo $single_expense->name; ?>
                            </td>
                            <td>
                                <?php echo $single_expense->date; ?>
                            </td>                              
                            <td>
                                <?php echo $single_expense->bankname; ?>
                            </td>
                            <td>
                                <?php echo $single_expense->total_bill; ?>
                            </td> 
                            <td>
                                <?php echo $single_expense->user; ?>
                            </td>
                            <!-- <td>
                            <div class="btn-group pull no-print pull-right">
                                <button type="button" class="btn btn-default btn-flat dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <ul class="dropdown-menu" role="menu">  
                                    <li><a  href="<?php //echo base_url().'prints/expense/'.$single_expense->id; ?>">
                                        <i class="fa fa-link"></i> Preview</a>
                                    </li>     
                                </ul>
                            </div>
                        </td>  --> 
                        </tr>
                        <?php
                            $counter++;
        					}
        				?>
                        <tr>
                            <th colspan="3">Total</th>
                             <th ></th>
                            <th  colspan="3"><?php echo $this->db->get_where('mp_langingpage', array('id' => 1))->result_array()[0]['currency'] ;?> <?php echo number_format($total_bill,'2','.','') ?></th>
                        </tr>
                            <?php 
                            }
                            else
                            {
                            ?>
                                <tr  class="text-center">
                                    <td colspan="9"><b>No expense record found</b></td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bootstrap model  -->
<?php $this->load->view('bootstrap_model.php'); ?>
<!-- Bootstrap model  ends-->        
