 
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
                                         <label for="name">Search Customer Name </label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'SearchCustomer',
                                                    'id'            => 'SearchCustomer',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Search  ',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="button" class="btn btn-theme" name="search" id="add"  value="add" data-toggle="modal" data-target="#addCompany" ><i class="fa fa-plus"></i> Add Customer</button>
                               </div>
                            </div>
                               
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                    <div class="row">
                            <div class="col-md-12">
                                <div id="customer_show_js">

                                </div>
                            </div>
                    </div>
                                  
                                    </div>
                                  
        </div>
 
    </div>
          
      
      </div>
                 </div>


    <div class="modal fade" id="addCompany" tabindex="-1" role="dialog" aria-labelledby="Add Products">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $page_header?> Form</h4>
      </div>
        <?php echo form_open('',array('class'=>'form-horizontal','id'=>'RegProductCompany')); ?>
      <div class="modal-body">
           
           
            <div class="row">
            <div class="col-md-12">
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Customer Name *</label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'name',
                                   'id'            => 'name',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Customer Name',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
                     
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Address </label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'address',
                                   'id'            => 'address',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Address ',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
            
                     
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Phone No</label>
                        <?php
                            echo form_input(array(
                                   'name'          => 'phone_no',
                                   'id'            => 'phone_no',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Phone no ',
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
          <button type="button" name="submittRegCustomer" id="submittRegCustomer" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        <?php echo form_close(); ?>  
    </div>
  </div>
</div>
 
<div class="modal fade" id="updateCustomer" tabindex="-1" role="dialog" aria-labelledby="Update Company">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Customer Details</h4>
      </div>
        
        <div id="show_updateCustomer">
            
        </div>
        </form>
    </div>
  </div>
</div>


<script>
  jQuery(document).ready(function(){
       
       
       jQuery('#error_message').hide();
       
       
        // Submit Product form 
        
        jQuery('#submittRegCustomer').on('click',function(){
          
            jQuery.ajax({
                    type:'post',
                    url : 'AddCustomer',
                    data: jQuery('#RegProductCompany').serialize(),
                    success:function(result){
                        
                         if(result == true){
                             alert('Customer register successfully....');
                             jQuery("#RegProductCompany").get(0).reset();  
                             jQuery('#addCompany').modal('toggle');
                             
                             //Onload Show last 20 products
       
                            jQuery.ajax({
                             type:'post',
                             url : 'RegCustomerShow',
                             success:function(result){
                                 jQuery('#customer_show_js').html(result);

                             }

                            });
                             
                             
                             
                         }else{
                            alert('Sorry! Customer not register.Check your input data...');  
                           jQuery('#error_message').show();
                         }

                    }

                   });
            
            
        });
        
        //Onload Show last 20 products
       
        jQuery.ajax({
         type:'post',
         url : 'RegCustomerShow',
         success:function(result){
             jQuery('#customer_show_js').html(result);
            
         }
         
        });
        
        
        //Search Product 
      jQuery('#SearchCustomer').keyup(function(){
           var search_query =  jQuery('#SearchCustomer').val().length;
   
           if(search_query>1){
              
               jQuery.ajax({
                type:'post',
                url : 'RegCustomerShowSearch',
                data: {'search_query':jQuery('#SearchCustomer').val()},
                success:function(result){
                    jQuery('#customer_show_js').html(result);
                    }
                });
           }else{
             jQuery.ajax({
                type:'post',
                url : 'RegCustomerShow',
                success:function(result){
                    jQuery('#customer_show_js').html(result);

                }

            });  
           }
                   
                   
         
       });
     
  })  
   
</script>
 
 