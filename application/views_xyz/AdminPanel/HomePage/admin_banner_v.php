 
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
<!--              <section class="course-finder" style="padding-bottom: 2%;">
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
                               
                                
                             
                            
                         </div>//section-content
                        
                        
                    </section>-->
                        
                    <div class="row">
                            <div class="col-md-12">
                                <div id="banner_show_js">

                                </div>
                            </div>
                    </div>
                                  
                                    </div>
                                  
        </div>
 
    </div>
      <div class="modal fade" id="updateBanner" tabindex="-1" role="dialog" aria-labelledby="Update Product">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Banner Details</h4>
      </div>
        
        <div id="show_updateBanner">
            
        </div>
        </form>
    </div>
  </div>
</div>    
      
      </div>
</div>


     
 
 
<script>
  jQuery(document).ready(function(){
      
        
       
        jQuery.ajax({
         type:'post',
         url : 'HomeBannerShow',
         success:function(result){
             jQuery('#banner_show_js').html(result);
            
         }
         
        });
      
     
  })  
   
</script>
 
 