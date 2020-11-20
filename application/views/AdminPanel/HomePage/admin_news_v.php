 
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
                            <?php echo form_open('',array('class'=>'form-horizontal','id'=>'InsertNewsForm','enctype'=>'multipart/form-data' )); ?>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-6 col-sm-5">
                                            <label for="name">News Title</label>
                                            <?php
                                               echo form_input(array(
                                                       'name'          => 'title',
                                                       'id'            => 'title',
                                                       'class'         => 'form-control',
                                                       'placeholder'   => 'News Title',
                                                       'type'          => 'text',

                                                       ));

                                               ?>

                                        </div>
                                        <div class="col-md-3 col-sm-5">
                                            <label for="name">News Date</label>
                                            <?php
                                               echo form_input(array(
                                                       'name'          => 'news_date',
                                                       'class'         => 'form-control datepicker',
                                                       'placeholder'   => 'news Date',
                                                       'type'          => 'text',

                                                       ));

                                               ?>

                                        </div>
                                    </div>
                                    
                                        <div class="col-md-12 col-sm-5">
                                               <div class="col-md-6 col-sm-5">
                                            <label for="name">Description</label>
                                            <?php
                                               echo form_textarea(array(
                                                'name'          => 'description',
                                                'id'            => 'description',
                                                'cols'          => '40',
                                                 'rows'          => '2',
                                                'class'         => 'form-control',
                                                  
                                                ));

                                               ?>

                                        </div>
                                </div> 
                                <div class="col-md-12 col-sm-5">
                                                
                                            
                                            
                                        <div class="col-md-4 col-sm-5">
                                            

                                             <label for="name">Pictures</label>
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
                                          <button type="submit" name="addAdminEvents" value="addAdminEvents" id="addAdminNews" class="btn btn-theme"> <i class="fa fa-plus"></i> Save</button>
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
       
        
        
        
        
        
        
        
        
        
<div class="modal fade" id="updateNewsModel" tabindex="-1" role="dialog" aria-labelledby="Update Product">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Update News Details</h4>
      </div>
        
        <div id="show_updateNews">
            
        </div>
        </form>
    </div>
  </div>
</div>    
      
      </div>
</div>


     
 
 
<script>
  jQuery(document).ready(function(){
      
            $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });

       
       
       jQuery('#addAdminNews').on('click',function(){
           jQuery.ajax({
            type        : 'post',
            data        : jQuery('#InsertNewsForm').serialize(),
            processData : false,
            contentType : false,
            cache       : false,
            async       : false,
            url         : 'adminNewsInsert',
            success     : function(result){
                
//                jQuery.ajax({
//                    type:'post',
//                    url : 'adminNewsShow',
//                    success:function(result){
//                        jQuery('#gallery_show_js').html(result);
//
//                    }
//
//                   });

            }

           });
       });
       
       
        jQuery.ajax({
         type:'post',
         url : 'adminNewsShow',
         success:function(result){
             jQuery('#gallery_show_js').html(result);
            
         }
         
        });
      
     
  })  
   
</script>
 
 