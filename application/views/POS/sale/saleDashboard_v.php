 
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
                                        <label for="name">Select Customer *</label>
                                        <?php
                                            echo form_dropdown('customer', $customer,'',  'class="form-control" id="customer"');
                                        ?>
                                     <input type="hidden" name="formCode" id="formCode" value="<?php $rand = rand(1,10000000); $date = date('YmdHis'); echo md5($rand.$date);?>">   
                                    </div> 
                                    <div class="col-md-2 col-sm-5">
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
                                     <div class="col-md-2">
                                         <label for="name">Balance</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'customerBalance',
                                                    'id'            => 'customerBalance',
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
                                     <div class="col-md-2">
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
                                        <label for="name">Order by</label>
                                        <?php
                                            echo form_input(array(
                                                    'name'          => 'order_person',
                                                    'id'            => 'order_person',
                                                    'class'         => 'form-control ',
                                                    'placeholder'   => 'Order by name',
                                                    'type'          => 'text',
                                                      
 
                                                    ));
                                                
                                            ?>

                                    </div>    
                                     <div class="col-md-4">
                                        <label for="name">Phone Number</label>
                                        <?php
                                            echo form_input(array(
                                                    'name'          => 'phoneNumber',
                                                    'id'            => 'phoneNumber',
                                                    'class'         => 'form-control ',
                                                    'placeholder'   => 'Phone Number',
                                                    'type'          => 'text',
                                                      
 
                                                    ));
                                                
                                            ?>

                                    </div>    
                                         
                                     <div class="col-md-4">
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
                                                    'name'          => 'purchasePrice',
                                                    'id'            => 'purchasePrice',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Sale Price',
                                                    'type'          => 'text',
                                                    'readonly'      => 'readonly',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     <div class="col-md-2">
                                         <label for="name">Sale Price</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'SalePrice',
                                                    'id'            => 'SalePrice',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Sale Price',
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
//       jQuery("#general_customer").hide();
//       jQuery("#addphoneNumber").removeClass('col-md-4 col-sm-5').addClass("col-md-4 col-sm-5 col-md-offset-4");
       jQuery('#customer').on('change',function(){
            var customer = jQuery(this).val();
            jQuery('#customerBalance').val('');
            jQuery('#phoneNumber').val('');
            jQuery.ajax({
                    type:'post',
                    url : 'customerBalance',
                    dataType: 'json',
                    data : {'customer':customer},
                    success:function(data){
                        var customer_balance    = data['balance'];
                        var cust_phone          = data['cust_phone'];
                        var cust_id             = data['cust_id'];
                        var cust_name           = data['cust_name'];
                        if(cust_id === '1'){
                            jQuery('#order_person').val('');
                         }else{
                         jQuery('#order_person').val(cust_name);
                             
                        }
                        
                        jQuery('#phoneNumber').val(cust_phone);
                        

                        if(customer_balance>0){
                          jQuery('#customerBalance').val(customer_balance);  
                        }
                        else{
                            jQuery('#customerBalance').val('0');
                        } }
                    });
           
           
       });
       
       jQuery('#quantity').on('change',function(){
           
            var product_id = jQuery('#products').val();
            var quantity = jQuery(this).val();
            jQuery.ajax({
                type:'post',
                url : 'saleProductCheck',
                dataType: 'json',
                data : {'product_id':product_id,'quantity':quantity},
                success:function(data){
                    
                    var stockInfo = data['stockInfo'];
                  if(stockInfo==0){
                     alert('Not valid Stock');
                     jQuery('#quantity').val('');
                     jQuery('#products').val('');
                     jQuery('#purchasePrice').val('');
                     jQuery('#SalePrice').val('');
                     jQuery('#TotalAmount').val('');
                     jQuery('#products').focus();
                     return false;
                  }
                     
                    } 
                    });
           
           
       });
       
       
       //Show Product Info 
       jQuery('#products').on('change',function(){
            
            var product_id = jQuery(this).val();
            jQuery('#quantity').val('');
            jQuery('#purchasePrice').val('');
            jQuery('#TotalAmount').val('');
           
            
            jQuery.ajax({
                type:'post',
                url : 'StockProductInfo',
                dataType: 'json',
                data : {'product_id':product_id},
                success:function(data){
                    var pro_sal_price = data['product_info']['pro_sal_price'];
                    jQuery('#purchasePrice').val(pro_sal_price);
                    jQuery('#SalePrice').val(pro_sal_price);
                    
                    }
                    });
        });
       //Add Product 
       
       jQuery('#addProducts').on('click',function(){
            var product_id      = jQuery('#products').val();
            var quantity        = jQuery('#quantity').val();
            var SalePrice       = jQuery('#SalePrice').val();
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
           
             if(SalePrice ===''){
                alert('Please enter Price');
                jQuery('#SalePrice').focus();
                return false;
            }
           
           var data = {
               'formCode'       : formCode,
               'purchasePrice'  : SalePrice,
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
                            jQuery('#SalePrice').val('');
                            jQuery('#TotalAmount').val('');
                            
                            jQuery('#show_demo_products').html(results);  
                            var gTotal = jQuery('#gTotal').val();
                            var customerBalance = jQuery('#customerBalance').val();
                            jQuery("#currentAmount").val(parseInt(gTotal));
                            jQuery("#totalAmount").val(parseInt(gTotal)+parseInt(customerBalance));
                          
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
            var SalePrice       = jQuery('#SalePrice').val();
            var totalPrice      = quantity*SalePrice;
            jQuery('#TotalAmount').val(totalPrice);
            
        });
        //Enter Price 
        jQuery('#SalePrice').keyup(function(){
            var quantity        = jQuery('#quantity').val();
            var SalePrice       = jQuery('#SalePrice').val();
            var totalPrice      = quantity*SalePrice;
            jQuery('#TotalAmount').val(totalPrice);
        });
        
   
   jQuery("#saveProducts").on('click',function(){
       
       var customer         = jQuery('#customer').val();
       var orderDate        = jQuery('#orderDate').val();
       var payableAmount    = jQuery('#payableAmount').val();
       var currentAmount    = jQuery('#currentAmount').val();
       var formCode         = jQuery('#formCode').val(); 
       var order_person     = jQuery('#order_person').val(); 
       var phoneNumber      = jQuery('#phoneNumber').val(); 
       
       if(customer ===''){
                alert('Please Select Customer First');
                jQuery('#customer').focus();
                return false;
            }
       if(order_person ===''){
            
                   alert('Please Fill required field');
                    jQuery('#order_person').focus();
                    return false; 
             
                
            }
       if(orderDate ===''){
                alert('Please Select Date First');
                jQuery('#orderDate').focus();
                return false;
            }
         var dataSend =  {
             'customer'         : customer,
             'order_person'     : order_person,
             'currentAmount'    : currentAmount,
             'orderDate'        : orderDate,
             'payableAmount'    : payableAmount,
             'formCode'         : formCode,
             'phoneNumber'      : phoneNumber
         };   
            
      jQuery.ajax({
                type:'post',
                url : 'saveSale',
                
                data : dataSend,
                success:function(data){
                    alert('Stock Update Successfully');
                   location.reload();
                }
                    });      
            
        
   });
   
   
   
</script>
 
 