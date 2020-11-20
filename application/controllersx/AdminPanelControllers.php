<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
class AdminPanelController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
     *
     * @property CRUDModel
     *
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
        public $userInfo = '';
        public function __construct() {
                parent::__construct(); 
                ob_start();
                $this->load->model('CRUDModel');
                $this->load->model('SiteModel');
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);

        }
    public function admin_gallery(){
                if($this->input->post()):
                  
                    $title = $this->input->post('image_title');
                    $image_thumb = $this->CRUDModel->do_resize_gallery('file','SiteAssets/images/gallery');
                    $file_name_thum = $image_thumb['file_name'];
                    
                    $image = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/gallery');
                    $file_name = $image['file_name'];
                    
                    $data =array(
                      'title'=>$title,  
                      'image_thumb'=>$file_name_thum,  
                      'image'=>$file_name,  
                      'user_id'=>$this->userInfo->user_id,  
                    );
                    $this->CRUDModel->insert('site_gallery',$data);
                    redirect('adminGallery');
            endif;
            
            
            $this->data['site_status']      = $this->CRUDModel->dropDown('site_status', '', 'id', 'title',array('status'=>1));
            $this->data['page_title']       = "Admin Gallery | Al-ASR";
            $this->data['page_header']      = "Admin Gallery";
            $this->data['page_name']        = "AdminPanel/HomePage/admin_gallery_v";
            $this->load->view('AppTemplate/common',$this->data);
         }
    public function admin_gallery_show_js(){
                                 
            $gallery= $this->SiteModel->gallery_picture_show();
             
            
               if(!empty($gallery)):  
                    
                   
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($gallery).' Products</h3>';
               
        
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Image</th>
                                    <th>Title</th>
                                    
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($gallery as $Row):
                          
                             echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td><img height src="SiteAssets/images/gallery/'.$Row->image.'" style="border-radius: 20px;height: 200px;width: 200px;"></td>
                                    <td>'.$Row->title.'</td>
                                      
                                    <td>'.$Row->status_title.'</td>    
                                    <td><button id="'.$Row->id.'"  class="updateGalleryPic" data-toggle="modal" data-target="#updateGallery"><span class="fa fa-book text-success"></span></button></button></td>
                                </tr>';
                        $sn++;
                      endforeach;
                    
               
                 echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                         
                            //Delete Product 
                            jQuery('.deleteNav').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteNav',
                                    data: {'nav_id':id},
                                    success:function(result){
                                         jQuery.ajax({
                                            type:'post',
                                            url : 'HomeNavShow',
                                            success:function(result){
                                                jQuery('#nav_show_js').html(result);

                                            }

                                           });
                                         
                                    }

                                   });
                           });
                           
                           
                           
                             jQuery('.updateGalleryPic').on('click',function(){
                            var Gallery_pic_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateGallery',
                                data : {'Gallery_pic_id':Gallery_pic_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateGallery').html(result);
 
                                }

                               });

                         });
                            

                         });
                           
                           
                    


                    </script>
                    <?php
            endif;
            
            
          
        }
    public function admin_gallery_update_js(){
          $banner_id      = $this->input->post('Gallery_pic_id'); 
          $gallery_info    = $this->db->get_where('site_gallery',array('id'=>$banner_id))->row();
          $status          = $this->CRUDModel->dropDown('site_status', 'Select Status', 'id', 'title',array('status'=>1));
 
         if($gallery_info):
            
             
           
            echo '<form action="UpdateBannerData" class="form-horizontal" id="UpdateBannerForm" method="post" enctype="multipart/form-data">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
                    
                     
                     <div class="col-md-12 col-sm-5">
                        <label for="name">Banner Top Title</label>
                        <input type="text" name="title1" value="'.$gallery_info->title.'" id="uname" class="form-control" placeholder="Company Name  ">

                    </div>
                    
                        
                        <input type="hidden" name="banenr_id" value="'.$gallery_info->id.'" id="banenr_id" class="form-control">
                        <input type="hidden" name="old_image" value="'.$gallery_info->image.'" id="old_image" class="form-control">
                     
                    <div class="col-md-12 col-sm-5">
                        <br/>
                       
                         <label for="name">Banner Image</label>
                          <br/>
                        <img height="" src="Siteassets/images/main-slider/'.$gallery_info->image.'" style="border-radius: 20px;height: 100px;width: 250px;">
                        <input type="file" name="file"   id="file" class="form-control" placeholder="Select Image ">
                        
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Status</label>';
                            
                            echo form_dropdown('status', $status,$gallery_info->status,  'class="form-control" id="status"');
                                
                    echo '</div>
            </div>
            <div class="col-md-12" id="error_message">
                      
                     
                </div>
          </div>

     
      </div>
      <div class="modal-footer">
          <button type="submit" id="updateBannerRecord" value="updateBannerRecord" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
                 
         endif;
        
        
    }
    public function admin_home_nav(){
             
            $this->data['site_status']      = $this->CRUDModel->dropDown('site_status', '', 'id', 'title',array('status'=>1));
            $this->data['page_title']       = "Admin Home Nav | Al-ASR";
            $this->data['page_header']      = "Home Nav";
            $this->data['page_name']        = "AdminPanel/HomePage/admin_home_nav_v";
            $this->load->view('AppTemplate/common',$this->data);

        }
    public function register_nav_js(){
         $name           = $this->input->post('nav_name');
        $function       = $this->input->post('nav_function');
        $order          = $this->input->post('nav_order');
        
        $this->form_validation->set_rules('nav_name', 'Nav Name', 'required');
        $this->form_validation->set_rules('nav_function', 'Nav Function', 'required|is_unique[site_nav.function_name]');
        $this->form_validation->set_rules('nav_order', 'Nav order', 'required');
        
        
        if ($this->form_validation->run() == FALSE):
            $this->form_validation->set_error_delimiters('<div class="danger">', '</div>'); 
          echo   validation_errors();
             else:
                 $data = array(
                    'title'         => $name,
                    'function_name' => $function,
                    'nav_order'     => $order,
                     
                );

                $this->CRUDModel->insert('site_nav',$data);
                echo  true;

         endif;  
     }     
    public function home_nav_show_js(){
                             
            $site_nav      = $this->SiteModel->admin_site_nav();
             
            
               if(!empty($site_nav)):  
                    
                   
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($site_nav).' Products</h3>';
               
        
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Nav</th>
                                    <th>Function</th>
                                    
                                    <th>Nav Order</th>
                                    <th>Nav Status</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($site_nav as $Row):
                          
                             echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->site_title.'</td>
                                    <td>'.$Row->function_name.'</td>
                                    <td>'.$Row->nav_order.'</td>
                                    <td>'.$Row->status_title.'</td>    
                                    <td><button id="'.$Row->site_id.'"  class="deleteNav"><span class="fa fa-trash text-danger"></span></button></button></td>
                                </tr>';
                        $sn++;
                      endforeach;
                    
               
                 echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                         
                            //Delete Product 
                            jQuery('.deleteNav').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteNav',
                                    data: {'nav_id':id},
                                    success:function(result){
                                         jQuery.ajax({
                                            type:'post',
                                            url : 'HomeNavShow',
                                            success:function(result){
                                                jQuery('#nav_show_js').html(result);

                                            }

                                           });
                                         
                                    }

                                   });
                           });
                            

                         });
                           
                           
                    


                    </script>
                    <?php
                 
                 
                 
             endif;
        }
    public function nav_show_search_js(){
            $like                       = $this->input->post('search_query');
//            $where                      = array('user_company_id'=>$this->userInfo->company_id);
            $admin_site_nav_search            = $this->SiteModel->admin_site_nav_search($like);
 
               if($admin_site_nav_search):  
                  
                    echo '<h3 class="has-divider text-highlight">Last '.count($admin_site_nav_search).' Products</h3>';
               
        
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Nav</th>
                                    <th>Function</th>
                                    
                                    <th>Nav Order</th>
                                    <th>Nav Status</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($admin_site_nav_search as $Row):
                         echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->site_title.'</td>
                                    <td>'.$Row->function_name.'</td>
                                    <td>'.$Row->nav_order.'</td>
                                    <td>'.$Row->status_title.'</td>    
                                    <td><button id="'.$Row->site_id.'"  class="deleteNav"><span class="fa fa-trash text-danger"></span></button></button></td>
                                </tr>';
                       
                        $sn++;
                      endforeach;
                    
               
                 echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                            //Delete Product 
                            jQuery('.deleteNav').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteNav',
                                    data: {'nav_id':id},
                                    success:function(result){
                                         
                                          
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
 
                                         
                                         
                                         
                                    }

                                   });
                           });
                     
                    });


                    </script>
                    <?php
             endif;
        } 
    public function nav_delete_js(){
       $nav_id = $this->input->post('nav_id');
         
        $this->CRUDModel->deleteid('site_nav',array('id'=>$nav_id));
    }
  
     
    public function admin_home_banner(){

        
          $this->data['page_title']      = "Admin Home Banner | Al-ASR";
          $this->data['page_header']      = "Admin Home Banner";
          $this->data['page_name']        = "AdminPanel/HomePage/admin_banner_v";
          $this->load->view('AppTemplate/common',$this->data);

      }
    public function admin_home_banner_show_js(){
                                 
            $site_nav      = $this->SiteModel->home_banner_show();
             
            
               if(!empty($site_nav)):  
                    
                   
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($site_nav).' Products</h3>';
               
        
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Image</th>
                                    <th>Title Top</th>
                                    <th>Title Mid</th>
                                    <th>Title Bottom</th>
                                    <th>Button</th>
                                    <th>Function</th>
                                     <th>Order</th>
                                    <th>Status</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($site_nav as $Row):
                          
                             echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td><img height src="Siteassets/images/main-slider/'.$Row->image.'" style="border-radius: 20px;height: 100px;width: 250px;"></td>
                                    <td>'.$Row->title1.'</td>
                                    <td>'.$Row->title2.'</td>
                                    <td>'.$Row->title3.'</td>    
                                    <td>'.$Row->btn1_title.'</td>    
                                    <td>'.$Row->btn1_function.'</td>    
                                    <td>'.$Row->banner_order.'</td>    
                                    <td>'.$Row->status_title.'</td>    
                                    <td><button id="'.$Row->id.'"  class="updateNav" data-toggle="modal" data-target="#updateBanner"><span class="fa fa-book text-success"></span></button></button></td>
                                </tr>';
                        $sn++;
                      endforeach;
                    
               
                 echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                         
                            //Delete Product 
                            jQuery('.deleteNav').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteNav',
                                    data: {'nav_id':id},
                                    success:function(result){
                                         jQuery.ajax({
                                            type:'post',
                                            url : 'HomeNavShow',
                                            success:function(result){
                                                jQuery('#nav_show_js').html(result);

                                            }

                                           });
                                         
                                    }

                                   });
                           });
                           
                           
                           
                             jQuery('.updateNav').on('click',function(){
                            var banner_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateBanner',
                                data : {'banner_id':banner_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateBanner').html(result);
 
                                }

                               });

                         });
                            

                         });
                           
                           
                    


                    </script>
                    <?php
                 
                 
                 
             endif;
        }
   
    public function updat_banner_show(){
          $banner_id      = $this->input->post('banner_id'); 
          $banner_info    = $this->db->get_where('site_banner',array('id'=>$banner_id))->row();
          $status          = $this->CRUDModel->dropDown('site_status', 'Select Status', 'id', 'title',array('status'=>1));
 
         if($banner_info):
            
             
           
            echo '<form action="UpdateBannerData" class="form-horizontal" id="UpdateBannerForm" method="post" enctype="multipart/form-data">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
                    
                     
                     <div class="col-md-12 col-sm-5">
                        <label for="name">Banner Top Title</label>
                        <input type="text" name="title1" value="'.$banner_info->title1.'" id="uname" class="form-control" placeholder="Company Name  ">

                    </div>
                     <div class="col-md-12 col-sm-5">
                        <label for="name">Banner Middle Title</label>
                        <input type="text" name="title2" value="'.$banner_info->title2.'" id="address" class="form-control" placeholder="Address ">

                    </div>
                     <div class="col-md-12 col-sm-5">
                        <label for="name">Button Bame</label>
                        <input type="text" name="btnName" value="'.$banner_info->btn1_title.'" id="address" class="form-control" placeholder="Address ">

                    </div>
                     <div class="col-md-12 col-sm-5">
                        <label for="name">Button Function</label>
                        <input type="text" name="btnFunction" value="'.$banner_info->btn1_function.'" id="address" class="form-control" placeholder="Address ">

                    </div>
                     <div class="col-md-12 col-sm-5">
                        <label for="name">Banner Order</label>
                        <input type="text" name="banner_order" value="'.$banner_info->banner_order.'" id="banner_order" class="form-control" placeholder="Address ">

                    </div>
            
                     
                    <div class="col-md-12 col-sm-5">
                        <label for="name">Banner Bottom Title</label>
                        <input type="text" name="title3" value="'.$banner_info->title3.'" id="title3" class="form-control" placeholder="Phone no ">
                        <input type="hidden" name="banenr_id" value="'.$banner_info->id.'" id="banenr_id" class="form-control">
                        <input type="hidden" name="old_image" value="'.$banner_info->image.'" id="old_image" class="form-control">
                    </div>
                    <div class="col-md-12 col-sm-5">
                        <br/>
                       
                         <label for="name">Banner Image</label>
                          <br/>
                        <img height="" src="Siteassets/images/main-slider/'.$banner_info->image.'" style="border-radius: 20px;height: 100px;width: 250px;">
                        <input type="file" name="file"   id="file" class="form-control" placeholder="Select Image ">
                        
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Status</label>';
                            
                            echo form_dropdown('status', $status,$banner_info->status,  'class="form-control" id="status"');
                                
                    echo '</div>
            </div>
            <div class="col-md-12" id="error_message">
                      
                     
                </div>
          </div>

     
      </div>
      <div class="modal-footer">
          <button type="submit" id="updateBannerRecord" value="updateBannerRecord" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
                 
         endif;
        
        
    }
    
    public function updat_banner(){
            
        if($this->input->post()):
           
            
            $image = $this->CRUDModel->uploadDirectory('file','Siteassets/images/main-slider');
            $file_name = $image['file_name'];
            
            $file = '';
            if(empty($file_name)):
                $file = $this->input->post('old_image');
                else:
                $file = $file_name;
            endif;
           
            $data = array(
              'title1'          => $this->input->post('title1'),  
              'title2'          => $this->input->post('title2'),  
              'title3'          => $this->input->post('title3'),  
              'btn1_title'      => $this->input->post('btnName'),  
              'btn1_function'   => $this->input->post('btnFunction'),  
                 
              'banner_order'    => $this->input->post('banner_order'),  
              'image'           => $file,  
              'status'          => $this->input->post('status'),  
                
            );
            $where = array(
              'id'=>$this->input->post('banenr_id') 
            );  
            
            $this->CRUDModel->update('site_banner',$data,$where);
            redirect('adminBanner');
        endif;
        
         
    }
}




