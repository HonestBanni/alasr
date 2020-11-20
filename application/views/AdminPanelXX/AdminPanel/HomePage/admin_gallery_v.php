 
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
                            <?php echo form_open('',array('class'=>'form-horizontal','id'=>'NavForm','enctype'=>'multipart/form-data' )); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4 col-sm-5">
                                            <label for="name">Picture Title</label>
                                            <?php
                                               echo form_input(array(
                                                       'name'          => 'image_title',
                                                       'id'            => 'image_title',
                                                       'class'         => 'form-control',
                                                       'placeholder'   => 'Picture Title',
                                                       'type'          => 'text',

                                                       ));

                                               ?>

                                        </div>
                                        <div class="col-md-4 col-sm-5">
                                            

                                             <label for="name">Gallery Pictures</label>
                                              <br/>

                                              <input type="file" name="file" required="required"  id="file" class="form-control" placeholder="Select Image ">

                                        </div>
                                        
                                        <div class="col-md-8 col-sm-5">
                                            
                                                <?php
                                                if( validation_errors()):
                                                    
                                                     echo validation_errors();
                                                endif;
                                                
                                                ?>
                                        </div>
                                        

                                </div> 
                                     
                                </div>
                                <div style="padding-top:1%;">
                                      <div class="col-md-2 pull-right">
                                          <button type="submit" name="addGalleryImages" value="addGalleryImages" id="addGalleryImages" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
                                     </div>
                                  </div>
                                <?php echo form_close(); ?>    
                        </div>
                        
                        
                    </section>
                        
                    <div class="row">
                            <div class="col-md-12">
                                <div id="gallery_show_js">

                                </div>
                            </div>
                    </div>
                                  
                                    </div>
                                  
        </div>
 
    </div>
       
        
        
        
        
        
        
        
        
        
<div class="modal fade" id="updateGallery" tabindex="-1" role="dialog" aria-labelledby="Update Product">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update Banner Details</h4>
      </div>
        
        <div id="show_updateGallery">
            
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
         url : 'adminGalleryShow',
         success:function(result){
             jQuery('#gallery_show_js').html(result);
            
         }
         
        });
      
     
  })  
   
</script>
 
 