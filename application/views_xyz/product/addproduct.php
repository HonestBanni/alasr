            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>Product</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="dashboard">Dashboard</a>
                        </li>
                        <li>
                            <a>Product</a>
                        </li>
                        <li class="active">
                            <strong>Add product</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>


<div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Product Registration Form</h5>
<!--                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                    <li><a href="#">Config option 1</a>
                                    </li>
                                    <li><a href="#">Config option 2</a>
                                    </li>
                                </ul>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>-->
                        </div>
                        <div class="ibox-content">
                            
                            <form method="post" class="form-horizontal">
                                
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="productcode">Product CODE</label>
                                     <?php echo form_error('productcode'); ?>
                                    <div class="col-sm-10">
                                       
                                       
                                        <?php 
                                            if(@$pro_detail):
                                                echo form_input(array('id' => 'productcode','value' => $pro_detail->pro_code,'readonly'=>'readonly', 'name' => 'productcode','class'=>'form-control'));
                                            else:
                                                echo form_input(array('id' => 'productcode', 'name' => 'productcode','class'=>'form-control'));
                                            endif;
                                         ?>
                                         
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group"><label class="col-sm-2 control-label">Product Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" value="<?php if(@$pro_detail): echo $pro_detail->pro_name; endif;?>" name="productname" required="required">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                    <div class="form-group"><label class="col-sm-2 control-label">Label Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" value="<?php if(@$pro_detail): echo $pro_detail->pro_lbl_price; endif;?>" required="required" name="labelprice" id="labelprice">
                                        </div>
                                    </div>
<!--                                <div class="hr-line-dashed"></div>-->
<!--                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Purchase Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="purchaseprice" >
                                    </div>
                                </div>-->
                                 <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Sale Price</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" required="required"  name="salprice" value="<?php if(@$pro_detail): echo $pro_detail->pro_sal_price; endif;?>"  id="saleprice">
                                        <input type="hidden" class="form-control" name="proId" value="<?php if(@$pro_detail): echo $pro_detail->pro_id; endif;?>"  id="saleprice">
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>  
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" >Company name</label>

                                    <div class="col-sm-10">
                                    
                                        <?php 
                                        if(@$pro_detail):
                                            echo form_dropdown('companyname', $companies,$pro_detail->pro_compId,  'class="form-control" id="my_id"');
                                            else:
                                            echo form_dropdown('companyname', $companies, '',  'class="form-control" id="my_id"');
                                        endif;
                                        
                                        ?>
                                    </div>
                                </div>
                                
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Minimum stock</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mmstock"  value="<?php if(@$pro_detail): echo $pro_detail->pro_mid_stock; endif;?>" >
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Purchase Discount</label>
                                    <div class="col-sm-10">
                                        <input type="text" value="<?php if(@$pro_detail): echo $pro_detail->pro_pur_disc; endif;?>" class="form-control" name="pur_discount" id="pur_discount" >
                                    </div>
                                </div>
                                <div class="hr-line-dashed"></div>
                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <button class="btn btn-white" type="reset">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Save changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>