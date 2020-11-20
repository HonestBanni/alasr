 
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
                                      
                                     <div class="col-md-6 col-sm-5">
                                         <label for="name">Product Search</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'SearchProduct',
                                                    'id'            => 'SearchProduct',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Product Search  ',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="button" class="btn btn-theme" name="search" id="add"  value="add" data-toggle="modal" data-target="#addProducts" ><i class="fa fa-plus"></i> Add Product</button>
                               </div>
                            </div>
                               
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                    <div class="row">
                            <div class="col-md-12">
                                <div id="product_show_js">

                                </div>
                            </div>
                    </div>
                                  
                                    </div>
                                  
        </div>
 
    </div>
          
      
      </div>
                 </div>


    <div class="modal fade" id="addProducts" tabindex="-1" role="dialog" aria-labelledby="Add Products">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $page_header?> Form</h4>
      </div>
         
        <?php echo form_open('',array('class'=>'form-horizontal','id'=>'ProductForm')); ?>
      <div class="modal-body">
           
           
            <div class="row">
            <div class="col-md-12">
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Product Name *</label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'product_name',
                                   'id'            => 'product_name',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Product Name',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Product Company *</label>
                        <?php
                           echo form_dropdown('companyname', $companies,'',  'class="form-control" id="companyname"');

                           ?>

                    </div>
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Purchase Price *</label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'sale_price',
                                   'id'            => 'sale_price',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Purchase Price',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
            </div>
            <div class="col-md-12">
                     
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Show Alert Minimum stock *</label>
                        <?php
                            echo form_input(array(
                                   'name'          => 'mine_stock',
                                   'id'            => 'mine_stock',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Show Alert Minimum stock',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
                  
              <!--//form-group-->
                
             
            </div>
             <div class="col-md-12" id="error_message">
                     <br/>
                     <strong class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;Please Fill All Required Field (*)</strong>
                
             
            </div>
                
          </div>

     
      </div>
      <div class="modal-footer">
          
          <button type="button" name="submittProductForm" id="submittProductForm" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        <?php echo form_close(); ?>  
    </div>
  </div>
</div>
<div class="modal fade" id="updateProduct" tabindex="-1" role="dialog" aria-labelledby="Update Product">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Product Details</h4>
      </div>
        
        <div id="show_updateProduct">
            
        </div>
        </form>
    </div>
  </div>
</div>
 
<script>
  jQuery(document).ready(function(){
       jQuery('#error_message').hide();
        // Submit Product form 
        
        jQuery('#submittProductForm').on('click',function(){
          
            jQuery.ajax({
                    type:'post',
                    url : 'RegisterProducts',
                    data: jQuery('#ProductForm').serialize(),
                    success:function(result){
                        
                         if(result == true){
                             alert('Product register successfully....');
                             jQuery("#ProductForm").get(0).reset();  
                             jQuery('#addProducts').modal('toggle');
                             
                             //Onload Show last 20 products
       
                            jQuery.ajax({
                             type:'post',
                             url : 'ProductShow',
                             success:function(result){
                                 jQuery('#product_show_js').html(result);

                             }

                            });
                             
                             
                             
                         }else{
                           alert('Sorry! product not register.Check your input data...');  
                           jQuery('#error_message').show();
                         }

                    }

                   });
            
            
        });
        
        //Onload Show last 20 products
       
        jQuery.ajax({
         type:'post',
         url : 'ProductShow',
         success:function(result){
             jQuery('#product_show_js').html(result);
            
         }
         
        });
        
        
        //Search Product 
      jQuery('#SearchProduct').keyup(function(){
           var search_query =  jQuery('#SearchProduct').val().length;
   
           if(search_query>1){
              
               jQuery.ajax({
                type:'post',
                url : 'ProductShowSearch',
                data: {'search_query':jQuery('#SearchProduct').val()},
                success:function(result){
                    jQuery('#product_show_js').html(result);

                }

            });
           }else{
             jQuery.ajax({
                type:'post',
                url : 'ProductShow',
                success:function(result){
                    jQuery('#product_show_js').html(result);

                }

            });  
           }
                   
                   
         
       });
     
  })  
   
</script>
 
 