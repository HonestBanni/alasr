 
<div class="content container">
    <div class="page-wrapper">
        <header class="page-heading clearfix">
            <h1 class="heading-title pull-left"><?php echo $page_header?></h1>
                <div class="breadcrumbs pull-right">
                    <ul class="breadcrumbs-list">
                        <li class="breadcrumbs-label">You are here:</li>
                        <li><?php echo anchor('Dashboard', 'Home');?> 
                          <i class="fa fa-angle-right">
                          </i>
                        </li>
                        <li class="current"><?php echo $page_header?></li>
                    </ul>
                </div>
      <!--//breadcrumbs-->
    </header> 
    <div class="page-content">
        
        
        
        
        
        <div class="row">
          <div class="col-md-12">
              <section class="course-finder" style="padding-bottom: 2%;">
                        <h1 class="section-heading text-highlight">
                            <span class="line"><?php echo $page_header?> Panel</span>
                        </h1>
                        <div class="section-content" >
                                <div class="row">
                                     <div class="col-md-4 col-sm-5">
                                        <label for="name">Select Company *</label>
                                        <?php
                                            echo form_dropdown('companyname', $companies,'',  'class="form-control" id="companyname"');
                                        ?>
                                     <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">   
                                    </div>    
                                     <div class="col-md-2">
                                         <label for="name">Balance</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'CompanyBalance',
                                                    'id'            => 'CompanyBalance',
                                                    'class'         => 'form-control',
                                                    'readonly'         => 'readonly',
                                                    'placeholder'   => '',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2">
                                         <label for="name">Current Amount</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'currentAmount',
                                                    'id'            => 'currentAmount',
                                                    'class'         => 'form-control',
                                                    'readonly'         => 'readonly',
                                                    'placeholder'   => '',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-4">
                                         <label for="name">Total Amount</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'totalAmount',
                                                    'id'          => 'totalAmount',
                                                     
                                                    'class'         => 'form-control',
                                                    'placeholder'   => '',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                                <div class="row">
                                     <div class="col-md-4 col-sm-5">
                                        <label for="name">Order Date *</label>
                                        <?php
                                            echo form_input(array(
                                                    'name'          => 'orderDate',
                                                    'id'            => 'orderDate',
                                                    'class'         => 'form-control datepicker',
                                                    'placeholder'   => 'Order Date',
                                                    'type'          => 'text',
                                                    'value'         => date('d-m-Y'),
 
                                                    ));
                                                
                                            ?>

                                    </div>    
                                     <div class="col-md-4 col-md-offset-4">
                                         <label for="name">Payable Amount</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'payableAmount',
                                                    'id'            => 'payableAmount',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Payable Amount',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                            <hr/>
                             <div class="row">
                                     <div class="col-md-3">
                                        <label for="name">Product *</label>
                                        <?php
                                            echo form_dropdown('products', $products,'',  'class="form-control" id="products"');
                                                
                                            ?>

                                        </div>    
                                     <div class="col-md-2">
                                        <label for="name">Quantity</label>
                                        <?php
                                            echo form_input(array(
                                                    'name'          => 'quantity',
                                                    'id'            => 'quantity',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Quantity',
                                                    'type'          => 'number',
 
                                                    ));   
                                            ?>

                                        </div>    
                                     <div class="col-md-2">
                                         <label for="name">Purchase Price</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'PurchasePrice',
                                                    'id'            => 'PurchasePrice',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Purchase Price',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2">
                                         <label for="name">Total Amount</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'TotalAmount',
                                                    'id'            => 'TotalAmount',
                                                    'readonly'      => 'readonly',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Total Amount',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     
                                </div>   
                          <div style="padding-top:1%;">
                                <div class="col-md-4 pull-right">
                                     <button type="button" class="btn btn-theme" name="addProducts" id="addProducts"  ><i class="fa fa-plus"></i> Add Items</button>
                                     <button type="button" class="btn btn-theme" name="saveProducts" id="saveProducts"  ><i class="fa fa-book"></i> Save</button>
                               </div>
                            </div>
                               
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                    <div class="row">
                            <div class="col-md-12">
                               
                                    <div id="show_demo_products">
                                
                                    </div>
                                
                                    
                                </div>
                          
                    </div>
                                  
                                    </div>
                                  
        </div>
 
    </div>
          
      
      </div>
                 </div>


     
     <script>
  $( function() {
    $( ".datepicker" ).datepicker({
         changeMonth: true,
    changeYear: true,
    dateFormat: 'dd-mm-yy'
    });
  } );
  
  
  
  </script>  

<script>
  jQuery(document).ready(function(){});
       
       //Show compnay balance 
       jQuery('#companyname').on('change',function(){
            var companyname = jQuery(this).val();
            jQuery('#CompanyBalance').val('');
           jQuery.ajax({
                type:'post',
                url : 'companyBalance',
                dataType: 'json',
                data : {'companyname':companyname},
                success:function(data){
                    var company_balance = data['balance'];
                    
                    if(company_balance>0){
                      jQuery('#CompanyBalance').val(company_balance);  
                    }
                    else{
                        jQuery('#CompanyBalance').val('0');
                    } }
                    });
           
           
       });
       //Show Product Info 
       jQuery('#products').on('change',function(){
            
            var product_id = jQuery(this).val();
            jQuery('#quantity').val('');
            jQuery('#PurchasePrice').val('');
            jQuery('#TotalAmount').val('');
            
            jQuery.ajax({
                type:'post',
                url : 'StockProductInfo',
                dataType: 'json',
                data : {'product_id':product_id},
                success:function(data){
                    var pro_sal_price = data['product_info']['pro_sal_price'];
                    jQuery('#PurchasePrice').val(pro_sal_price);
                    
                    }
                    });
        });
       //Add Product 
       
       jQuery('#addProducts').on('click',function(){
            var product_id      = jQuery('#products').val();
            var quantity        = jQuery('#quantity').val();
            var purchasePrice   = jQuery('#PurchasePrice').val();
            var formCode        = jQuery('#formCode').val(); 
            
            if(product_id ===''){
                alert('Please Select Product First');
                jQuery('#products').focus();
                return false;
            }
            
            if(quantity ===''){
                alert('Please enter Quantity');
                jQuery('#quantity').focus();
                return false;
            }
           
             if(purchasePrice ===''){
                alert('Please enter Price');
                jQuery('#PurchasePrice').focus();
                return false;
            }
           
           var data = {
               'formCode'       : formCode,
               'purchasePrice'  : purchasePrice,
               'quantity'       : quantity,
               'product_id'     : product_id
           };
           jQuery.ajax({
                type:'post',
                url : 'addProductDemo',
//                dataType: 'json',
                data : data,
                success:function(result){
                    
                 jQuery.ajax({
                        type:'post',
                        url : 'showProductDemo',
        //                dataType: 'json',
                        data : {'formCode': formCode},
                        success:function(results){
                            
                            jQuery('#products').val('');
                            jQuery('#quantity').val('');
                            jQuery('#PurchasePrice').val('');
                            jQuery('#TotalAmount').val('');
                            
                            jQuery('#show_demo_products').html(results);  
                            var gTotal = jQuery('#gTotal').val();
                            var CompanyBalance = jQuery('#CompanyBalance').val();
                            jQuery("#currentAmount").val(parseInt(gTotal));
                            jQuery("#totalAmount").val(parseInt(gTotal)+parseInt(CompanyBalance));
                          
                        }  
                    });
                   
                     
                    }
                    });
        });
        
        //Enter Quantity 
        jQuery('#quantity').keyup(function(){
            var product         = jQuery('#products').val();
            if(product ===''){
                alert('Please Select Product First');
                jQuery('#products').focus();
                return false;
            }
            var quantity        = jQuery('#quantity').val();
            var PurchasePrice   = jQuery('#PurchasePrice').val();
            var totalPrice      = quantity*PurchasePrice;
            jQuery('#TotalAmount').val(totalPrice);
            
        });
        //Enter Price 
        jQuery('#PurchasePrice').keyup(function(){
            var quantity        = jQuery('#quantity').val();
            var PurchasePrice   = jQuery('#PurchasePrice').val();
            var totalPrice      = quantity*PurchasePrice;
            jQuery('#TotalAmount').val(totalPrice);
        });
        
   
   jQuery("#saveProducts").on('click',function(){
       
       var companyname      = jQuery('#companyname').val();
       var orderDate        = jQuery('#orderDate').val();
       var payableAmount    = jQuery('#payableAmount').val();
       var currentAmount    = jQuery('#currentAmount').val();
       var formCode         = jQuery('#formCode').val(); 
       
       if(companyname ===''){
                alert('Please Select Company First');
                jQuery('#companyname').focus();
                return false;
            }
       if(orderDate ===''){
                alert('Please Select Company First');
                jQuery('#orderDate').focus();
                return false;
            }
      jQuery.ajax({
                type:'post',
                url : 'saveStock',
                 
                data : {'companyname':companyname,'currentAmount':currentAmount,'orderDate':orderDate,'payableAmount':payableAmount,'formCode':formCode},
                success:function(data){
                   
                    alert('Stock Update Successfully');
                   location.reload();
                }
                    });      
            
        
   });
   
   
   
</script>
 
 