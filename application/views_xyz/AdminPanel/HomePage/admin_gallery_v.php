 
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
                                    <button   class="btn btn-theme" data-toggle="modal" data-target="#addGalleryPictures"> Add Gallery Pictures</button>
                                    <!--<button type="button" class="btn btn-theme" name="search" id="1"  value="updateBanner" data-toggle="modal" data-target="#addGalleryPictures" ><i class="fa fa-plus"></i> Add Gallery Pictures</button>-->
                               </div>
                            </div>
                               
                                
                             
                            
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
  
    <div class="modal fade" id="addGalleryPictures" tabindex="-1" role="dialog" aria-labelledby="Add Products">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><?php echo $page_header?> Add Pictures</h4>
      </div>
         
        <?php echo form_open('',array('class'=>'form-horizontal','id'=>'NavForm','enctype'=>'multipart/form-data' )); ?>
      <div class="modal-body">
           
           
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
                     
                
                    <div class="col-md-12 col-sm-5">
                        <br/>
                       
                         <label for="name">Gallery Pictures</label>
                          <br/>
                        
                        <input type="file" name="file"   id="file" class="form-control" placeholder="Select Image ">
                        
                    </div>
                     
                     
            </div> 
             <div class="col-md-6 offset-md-4" id="error_message">
                 
                 
                     <!--<strong class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;Please Fill All Required Field (*)</strong>-->
                     <strong class="text-danger"><div id="show_error_msg"></div></strong>
                
             
            </div>
                
          </div>

     
      </div>
      <div class="modal-footer">
          
          <button type="submit" name="submitGallery" id="submitGallery" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        <?php echo form_close(); ?>  
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
 
 