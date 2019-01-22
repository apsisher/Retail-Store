<section class="content">
    <div class="row">
        <ol class="breadcrumb pull-left">
            <li>
                <a href="<?php echo base_url('homepage'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">Layout</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <?php echo form_label('Update logo :'); ?>
                </div>
                <div class="box-body margin">
                    <?php
        				$logo_attributes = array('id'=>'logo_form','method'=>'post','class'=>'form-horizontal');
        			?>
                        <?php echo form_open_multipart('Layout/logo',$logo_attributes); ?>
                            <div class="form-group">
                                <?php
                					echo img(array('width'=>'250px','height'=>'auto','src'=>'uploads/systemimgs/'.$company_record[0]->logo,'name'=>'Edit_customer_picture'));
                				?>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="file" class=" btn-lg btn-flat btn btn-default" name="company_logo" data-validate="required" data-message-required="Value Required">
                                </div>
                            </div>
                            <div class="form-group">
                                 <?php
                                    $data = array('class'=>'btn btn-info btn-flat btn-lg','type' => 'submit','name'=>'save_logo','value'=>'true', 'content' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> Save logo');
                                    echo form_button($data);
                                 ?>
                            </div>
                         <?php echo form_close(); ?>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-info">
                <div class="box-header">
                    <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                    <?php echo form_label('Default Background image :'); ?>
                </div>
                <div class="box-body margin">
                    <?php
        					$banner_attributes = array('id'=>'banner_form','method'=>'post','class'=>'form-horizontal');
        			?>
                        <?php echo form_open_multipart('Layout/banner',$banner_attributes); ?>
                            <div class="form-group">
                                <?php
                                    echo img(array('width'=>'100%','height'=>'250px','src'=>'uploads/systemimgs/'.$company_record[0]->banner,'name'=>'Edit_customer_picture'));
                                ?>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="file" name="company_thumbnail" class=" btn-lg btn-flat btn btn-default" data-validate="required" data-message-required="Value Required">
                                </div>
                            </div>
                            <div class="form-group">
                                <?php
                                    $data = array('class'=>'btn btn-info btn-flat btn-lg','type' => 'submit','name'=>'save_banner','value'=>'true', 'content' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> Save banner');
                                    echo form_button($data);
                                 ?>
                            </div>
                        <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="content">
    <div class="box box-info">
        <div class="box-header text-center">
            <h3 class="box-title"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> <?php echo $title1; ?></h3>
        </div>
        <div class="box-body">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <?php
					$Contact_attributes = array('id'=>'layout_form','method'=>'post','class'=>'form-horizontal');
    			?>
                    <?php echo form_open('Layout/details',$Contact_attributes); ?>
                        <!--.form group -->
                        <div class="form-group">
                            <?php echo form_label('Company Name:'); ?>
                            <?php
            					$data = array('class'=>'form-control input-lg','type'=>'text', 'value'=>$company_record[0]->companyname,'name'=>'company_name');
            					echo form_input($data);
            				?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Company description:'); ?>
                            <?php
            					$data = array('class'=>'form-control input-lg','type'=>'text','value'=>$company_record[0]->companydescription,'name'=>'company_description');
            						echo form_input($data);
            				?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Company Keywords:'); ?>
                            <?php
                                $data = array('class'=>'form-control input-lg','type'=>'text','value'=>$company_record[0]->companykeywords,'name'=>'company_keywords');
                                echo form_input($data);
                            ?>
                        </div>                        
                        <div class="form-group">
                            <?php echo form_label('Company Address:'); ?>
                            <?php
                                $data = array('class'=>'form-control input-lg','type'=>'text','value'=>$company_record[0]->address,'name'=>'companyaddress');
                                echo form_input($data);
                            ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Company Email:'); ?>
                            <?php
                                $data = array('class'=>'form-control input-lg','type'=>'email','value'=>$company_record[0]->email,'name'=>'companyemail');
                                echo form_input($data);
                            ?>
                        </div><div class="form-group">
                            <?php echo form_label('Company Contact:'); ?>
                            <?php
            					$data = array('class'=>'form-control input-lg','type'=>'text','value'=>$company_record[0]->contact,'name'=>'companycontact');
            					echo form_input($data);
            				?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Currency :'); ?>
                            <?php
            					$data = array('class'=>'form-control input-lg','type'=>'text', 'value'=>$company_record[0]->currency ,'name'=>'company_currency');
            					echo form_input($data);
            				 ?>
                        </div>
                        <div class="form-group">
                            <?php echo form_label('Language :'); ?>
                            <?php
            					$data = array('class'=>'form-control input-lg','type'=>'text', 'value'=>$company_record[0]->language ,'name'=>'company_language');
            					echo form_input($data);
            				 ?>
                        </div> 
                        <div class="form-group">
                            <?php echo form_label('Theme primary:'); ?>
                            <a class="btn btn-default btn-sm " href="<?php echo base_url('layout/default_settings'); ?>"> Reset default 
                            </a>
                             <br>
                             <br>
                            <div class="input-group my-colorpicker2">
                              <?php
                                $data = array('class'=>'form-control my-colorpicker3 input-lg','type'=>'text', 'value'=>$company_record[0]->primarycolor,'name'=>'company_primary_color');
                                echo form_input($data);
                              ?>
                              <div class="input-group-addon">
                                <i></i>
                              </div>
                            </div>
                        </div>                        
                        <div class="form-group">
                            <?php echo form_label('Theme primary hover :'); ?>
                            <div class="input-group my-colorpicker2">
                              <?php
                                $data = array('class'=>'form-control my-colorpicker3 input-lg','type'=>'text', 'value'=>$company_record[0]->theme_pri_hover,'name'=>'company_primary_hover');
                                echo form_input($data);
                              ?>
                              <div class="input-group-addon">
                                <i></i>
                              </div>
                            </div>
                        </div>  
                        <div class="form-group">
                            <?php echo form_label('Verified invoice Expire time (in days) :'); ?>
                                <?php
                					$data = array('class'=>'form-control input-lg','type'=>'number', 'value'=>$company_record[0]->expirey ,'name'=>'company_expire_time');
                					echo form_input($data);
                				 ?>
                        </div>
                        <div class="form-group">
                            <?php
                                $data = array('class'=>'btn btn-info btn-flat btn-lg','type' => 'submit','name'=>'save_company_details','value'=>'true', 'content' => '<i class="fa fa-floppy-o" aria-hidden="true"></i> Save Company details');
                                echo form_button($data);
                             ?>
                        </div>
                    <?php echo form_close(); ?>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</section>