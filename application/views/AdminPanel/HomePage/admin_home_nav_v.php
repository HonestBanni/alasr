 
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
                                         <label for="name">Nav Search</label>
                                         <?php
                                            echo form_input(array(
                                                    'name'          => 'SearchNav',
                                                    'id'            => 'SearchNav',
                                                    'class'         => 'form-control',
                                                    'placeholder'   => 'Nav Search  ',
                                                    'type'          => 'text',
 
                                                    ));
                                                
                                            ?>
                                     
                                     </div>
                                     
                                </div>
                          <div style="padding-top:1%;">
                                <div class="col-md-2 pull-right">
                                    
                                    <button type="button" class="btn btn-theme" name="search" id="add"  value="add" data-toggle="modal" data-target="#addNav" ><i class="fa fa-plus"></i> Add Product</button>
                               </div>
                            </div>
                               
                                
                             
                            
                         </div><!--//section-content-->
                        
                        
                    </section>
                        
                    <div class="row">
                            <div class="col-md-12">
                                <div id="nav_show_js">

                                </div>
                            </div>
                    </div>
                                  
                                    </div>
                                  
        </div>
 
    </div>
          
      
      </div>
                 </div>


    <div class="modal fade" id="addNav" tabindex="-1" role="dialog" aria-labelledby="Add Products">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $page_header?> Form</h4>
      </div>
         
        <?php echo form_open('',array('class'=>'form-horizontal','id'=>'NavForm')); ?>
      <div class="modal-body">
           
           
            <div class="row">
            <div class="col-md-12">
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Nav Name *</label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'nav_name',
                                   'id'            => 'nav_name',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Nav Name',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Function</label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'nav_function',
                                   'id'            => 'nav_function',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Nav Function',
                                   'type'          => 'text',

                                   ));

                           ?>

                    </div>
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Nav Order</label>
                        <?php
                           echo form_input(array(
                                   'name'          => 'nav_order',
                                   'id'            => 'nav_order',
                                   'class'         => 'form-control',
                                   'placeholder'   => 'Nav Order',
                                   'type'          => 'number',

                                   ));

                           ?>

                    </div>
            </div> 
             <div class="col-md-6 offset-md-4" id="error_message">
                 
                 
                     <!--<strong class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;Please Fill All Required Field (*)</strong>-->
                     <strong class="text-danger"><div id="show_error_msg"></div></strong>
                
             
            </div>
                
          </div>

     
      </div>
      <div class="modal-footer">
          
          <button type="button" name="submittNavForm" id="submittNavForm" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        <?php echo form_close(); ?>  
    </div>
  </div>
</div>
 
 
<script>
  jQuery(document).ready(function(){
      
       jQuery('#error_message').hide();
        // Submit Product form 
        
        jQuery('#submittNavForm').on('click',function(){
          
            jQuery.ajax({
                    type:'post',
                    url : 'RegisterNav',
                    data: jQuery('#NavForm').serialize(),
                    success:function(result){
                        
                         if(result == true){
                             alert('Product register successfully....');
                              
                             jQuery("#NavForm").get(0).reset();  
                             jQuery('#addNav').modal('toggle');
                             
                             //Onload Show last 20 products
       
                            jQuery.ajax({
                             type:'post',
                             url : 'HomeNavShow',
                             success:function(result){
                                 jQuery('#nav_show_js').html(result);

                             }

                            });
                             
                             
                             
                         }else{
//                           alert('Sorry! Nav not register.Check your input data...');
                           
                            jQuery('#show_error_msg').html(result);
                           jQuery('#error_message').show();
                         }

                    }

                   });
            
            
        });
        
        //Onload Show last 20 products
       
        jQuery.ajax({
         type:'post',
         url : 'HomeNavShow',
         success:function(result){
             jQuery('#nav_show_js').html(result);
            
         }
         
        });
        
        
        //Search Product 
      jQuery('#SearchNav').keyup(function(){
           var search_query =  jQuery('#SearchNav').val().length;
   
           if(search_query>1){
              
               jQuery.ajax({
                type:'post',
                url : 'SearchNav',
                data: {'search_query':jQuery('#SearchNav').val()},
                success:function(result){
                    jQuery('#nav_show_js').html(result);

                }

            });
           }else{
             jQuery.ajax({
                type:'post',
                url : 'HomeNavShow',
                success:function(result){
                    jQuery('#nav_show_js').html(result);

                }

            });  
           }
                   
                   
         
       });
     
  })  
   
</script>
 
 