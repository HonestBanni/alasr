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
    public function admin_home_news(){
         
        if($this->input->post('addAdminNews')):
             
                    
                     
                     $title         = $this->input->post('title');
                     $description   = $this->input->post('description');
                     $news_date   = $this->input->post('news_date');
                     
                     $this->form_validation->set_rules('title', 'Title Required', 'required');
                    
                      if ($this->form_validation->run()):
                        $image      = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/news');
                        $file_name  = $image['file_name'];
                    
                    $data =array(
                      'title'       => $title,  
                      'description' => $description,  
                      'image'       => $file_name,  
                      'news_date'   => date('Y-m-d',strtotime($news_date)),  
                      'user_id'     => $this->userInfo->user_id,  
                    );
                    $this->CRUDModel->insert('site_news',$data);
                    redirect('AdminNews');
            endif;
        endif;
        if($this->input->post('updateNews')):

                 $title             = $this->input->post('title');
                 $description       = $this->input->post('description');
                 $news_date         = $this->input->post('news_date');
                 $image_id          = $this->input->post('image_id');
                 $status            = $this->input->post('status');
                 
                    
                 $this->form_validation->set_rules('title', 'Picture Title', 'required');

                  if ($this->form_validation->run()):

                        $image              = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/news');
                        $file_name          = $image['file_name'];
                         
                        if(empty($file_name)):
                            $data =array(
                            'title'         => $title,  
                            'description'   => $description,  
                            'status'        => $status,  
                            'news_date'     => date('Y-m-d',strtotime($news_date)),  
                            'user_id'       =>$this->userInfo->user_id,  
                          );
                             else: 
                            $data =array(

                            'title'         => $title,  
                            'description'   => $description,
                            'image'   => $file_name,
                            'status'        => $status,  
                            'news_date'     => date('Y-m-d',strtotime($news_date)),  
                            'user_id'       => $this->userInfo->user_id, 

                            );
                        endif;
              $this->CRUDModel->update('site_news',$data,array('id'=>$image_id));
                redirect('AdminNews');
        endif;
        endif;
        if($this->input->post('deleteNews')):
            $id = $this->input->post('image_id');
            $this->CRUDModel->deleteid('site_news',array('id'=>$id));
            redirect('AdminNews');
        endif;    
            
            $this->data['site_status']      = $this->CRUDModel->dropDown('site_status', '', 'id', 'title',array('status'=>1));
            $this->data['page_title']       = "Admin News | Al-ASR";
            $this->data['page_header']      = "Admin News";
            $this->data['page_name']        = "AdminPanel/HomePage/admin_news_v";
            $this->load->view('AppTemplate/common',$this->data);
         }
    public function admin_home_news_insert(){
        
         if($this->input->post()):
             
                    
       
                     echo'<pre>';print_r($this->input->post());die;
                     $title         = $this->input->post('title');
                     $news_date         = $this->input->post('news_date');
                     $description   = $this->input->post('description');
                     
                     $this->form_validation->set_rules('image_title', 'Picture Title', 'required');
                   
//                      if ($this->form_validation->run()):
                        $image      = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/news');
                        $file_name  = $image['file_name'];
                    
                    $data =array(
                      'title'       => $title,  
                      'news_date'       => date('Y-m-d',strtotime($news_date)),  
                      'description' => $description,  
                      'image'       => $file_name,  
                      'user_id'     => $this->userInfo->user_id,  
                    );
                    $this->CRUDModel->insert('site_newss',$data);
//                    redirect('adminGallery');
//            endif;
            endif;
             
         }
         
    public function admin_news_show_js(){
                                 
            $gallery= $this->SiteModel->admin_news_show();
             
//            echo '<pre>';print_r($gallery);die;
               if(!empty($gallery)):  
                    
                   
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($gallery).' Products</h3>';
                    
                     echo '<div class="row page-row">';
                    foreach($gallery as $Row):
                          
                            
                                echo '<div class="col-md-3 col-12 text-center">
                                    <div class="album-cover"  style="min-height: 0px !important;">
                                        <a href="javascript:void(0)" id="'.$Row->id.'"  class="updateNews"  data-toggle="modal" data-target="#updateNewsModel"><img class="img-fluid" style="height: 140px;width: 259px;" src="SiteAssets/images/news/'.$Row->image.'" alt="'.$Row->title.'"></a>
                                        <div class="desc" style="padding: 1px !important;">
                                            <h4><small><a  href="javascript:void(0)"  id="'.$Row->id.'" class="updateNews"  data-toggle="modal" data-target="#updateNewsModel" ><strong>'.$Row->title.'</strong></a></small></h4>
                                            <h4><small>'.$Row->description.'</small></h4>
                                             
                                        </div>
                                    </div>
                                </div>';
                      
                      endforeach;
                     echo '</div>';
                
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
                           
                           
                           
                             jQuery('.updateNews').on('click',function(){
                             var news_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateNews',
                                
                                data : {'news_id':news_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateNews').html(result);
 
                                }

                               });

                         });
                            

                         });
                           
                           
                    


                    </script>
                    <?php
            endif;
            
            
          
        }
    
    public function admin_news_update_js(){
          $news_id          = $this->input->post('news_id'); 
          $site_news    = $this->db->get_where('site_news',array('id'=>$news_id))->row();
          $status          = $this->CRUDModel->dropDown('site_status', 'Select Status', 'id', 'title',array('status'=>1));
 
         if($site_news):
            
             
           
            echo '<form action="" class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
            
                    <div class="col-md-3 col-sm-5">
                        <label for="name">Title</label>
                        <input type="text" name="title" value="'.$site_news->title.'" id="title" class="form-control" placeholder="Company Name  ">
                    </div>
                    <div class="col-md-3 col-sm-5">
                        <label for="name">Date</label>
                        <input type="text" name="news_date" value="'.date('d-m-Y',strtotime($site_news->news_date)).'" id="news_date" class="form-control datepicker">
                    </div>
                    
                     
                    <div class="col-md-8 col-sm-5">
                        <label for="name">Description</label>
                        <textarea name="description" cols="60" rows="2" id="description" class="form-control">'.$site_news->description.'</textarea>

                    </div>
                        <input type="hidden" name="image_id" value="'.$site_news->id.'" id="banenr_id" class="form-control">
                        <input type="hidden" name="old_image" value="'.$site_news->image.'" id="old_image" class="form-control">
                     
                    <div class="col-md-12 col-sm-5">
                        <br/>
                       
                         <label for="name">News Image</label>
                          <br/>
                        <img height="" src="SiteAssets/images/news/'.$site_news->image.'" style="border-radius: 20px;height: 100px;width: 250px;">
                        <input type="file" name="file"   id="file" class="form-control" placeholder="Select Image ">
                        
                    </div>
                    
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Status</label>';
                            
                            echo form_dropdown('status', $status,$site_news->status,  'class="form-control" id="status"');
                                
                    echo '</div>
            </div>
            
          </div>

     
      </div>
      <div class="modal-footer">
            <button type="submit" name="updateNews"     value="updateNews"  class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="submit" name="deleteNews"     value="deleteNews"  class="btn btn-danger"> <i class="fa fa-trash"></i> Delete</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
                    ?>
                    <script>
  jQuery(document).ready(function(){
      
            $(function() {
            $('.datepicker').datepicker( {
               changeMonth: true,
                changeYear: true,
                 dateFormat: 'dd-mm-yy'
           
            });
        });    
        });    
                        <?php
                    
                    
                 
         endif;
        
        
    }    
    public function admin_gallery(){
            
        
            if($this->input->post('addGalleryImages')):
                     
                     $title = $this->input->post('image_title');
                     
                     $this->form_validation->set_rules('image_title', 'Picture Title', 'required');
                    
                      if ($this->form_validation->run()):
                        
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
            endif;
            if($this->input->post('updateGalleryImages')):
                     
                     $title     = $this->input->post('title');
                     $image_id  = $this->input->post('image_id');
                      
                     
                     $this->form_validation->set_rules('title', 'Picture Title', 'required');
                    
                      if ($this->form_validation->run()):
                        
                           
                            $image_thumb        = $this->CRUDModel->do_resize_gallery('file','SiteAssets/images/gallery');
                            $file_name_thum     = $image_thumb['file_name'];
                            $image              = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/gallery');
                            $file_name          = $image['file_name'];
                            
                            if(empty($file_name)):
                                $data =array(
                                'title'=>$title,  
                                'user_id'=>$this->userInfo->user_id,  
                              );
                                 else: 
                                $data =array(
                                  'title'=>$title,  
                                  'image_thumb'=>$file_name_thum,  
                                  'image'=>$file_name,  
                                  'user_id'=>$this->userInfo->user_id,  
                                );
                            endif;
                  $this->CRUDModel->update('site_gallery',$data,array('id'=>$image_id));
                    redirect('adminGallery');
            endif;
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
                    
                     echo '<div class="row page-row">';
                    foreach($gallery as $Row):
                          
                            
                                echo '<div class="col-md-3 col-12 text-center">
                                    <div class="album-cover"  style="min-height: 0px !important;">
                                        <a href="javascript:void(0)" id="'.$Row->id.'"  class="updateGalleryPic"  data-toggle="modal" data-target="#updateGallery"><img class="img-fluid" style="height: 140px;width: 259px;" src="SiteAssets/images/gallery/'.$Row->image.'" alt="'.$Row->title.'"></a>
                                        <div class="desc" style="padding: 1px !important;">
                                            <h4><small><a id="'.$Row->id.'"  class="updateGalleryPic"  data-toggle="modal" data-target="#updateGallery" href="javascript:void(0)">'.$Row->title.'</a></small></h4>
                                             
                                        </div>
                                    </div>
                                </div>';
                      
                      endforeach;
                     echo '</div>';
                
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
            
             
           
            echo '<form action="adminGallery" class="form-horizontal" method="post" enctype="multipart/form-data">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
                    <div class="col-md-12 col-sm-5">
                        <label for="name">Title</label>
                        <input type="text" name="title" value="'.$gallery_info->title.'" id="uname" class="form-control" placeholder="Company Name  ">
                    </div>
                    
                        
                        <input type="hidden" name="image_id" value="'.$gallery_info->id.'" id="banenr_id" class="form-control">
                        <input type="hidden" name="old_image" value="'.$gallery_info->image.'" id="old_image" class="form-control">
                     
                    <div class="col-md-12 col-sm-5">
                        <br/>
                       
                         <label for="name">Banner Image</label>
                          <br/>
                        <img height="" src="SiteAssets/images/gallery/'.$gallery_info->image.'" style="border-radius: 20px;height: 100px;width: 250px;">
                        <input type="file" name="file"   id="file" class="form-control" placeholder="Select Image ">
                        
                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Status</label>';
                            
                            echo form_dropdown('status', $status,$gallery_info->status,  'class="form-control" id="status"');
                                
                    echo '</div>
            </div>
            
          </div>

     
      </div>
      <div class="modal-footer">
            <button type="submit" name="updateGalleryImages" value="updateGalleryImages" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
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
                                    <td><img height src="SiteAssets/images/main-slider/'.$Row->image.'" style="border-radius: 20px;height: 100px;width: 250px;"></td>
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
                        <img height="" src="SiteAssets/images/main-slider/'.$banner_info->image.'" style="border-radius: 20px;height: 100px;width: 250px;">
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
           
            
            $image = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/main-slider');
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
    public function admin_member_registration(){
            
        
            if($this->input->post('addGalleryImages')):
                     
                     $title = $this->input->post('image_title');
                     
                     $this->form_validation->set_rules('image_title', 'Picture Title', 'required');
                    
                      if ($this->form_validation->run()):
                        
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
            endif;
            if($this->input->post('updateGalleryImages')):
                     
                     $title     = $this->input->post('title');
                     $image_id  = $this->input->post('image_id');
                      
                     
                     $this->form_validation->set_rules('title', 'Picture Title', 'required');
                    
                      if ($this->form_validation->run()):
                        
                           
                            $image_thumb        = $this->CRUDModel->do_resize_gallery('file','SiteAssets/images/gallery');
                            $file_name_thum     = $image_thumb['file_name'];
                            $image              = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/gallery');
                            $file_name          = $image['file_name'];
                            
                            if(empty($file_name)):
                                $data =array(
                                'title'=>$title,  
                                'user_id'=>$this->userInfo->user_id,  
                              );
                                 else: 
                                $data =array(
                                  'title'=>$title,  
                                  'image_thumb'=>$file_name_thum,  
                                  'image'=>$file_name,  
                                  'user_id'=>$this->userInfo->user_id,  
                                );
                            endif;
                  $this->CRUDModel->update('site_gallery',$data,array('id'=>$image_id));
                    redirect('adminGallery');
            endif;
            endif;
            
            
            $this->data['site_status']      = $this->CRUDModel->dropDown('site_status', '', 'id', 'title',array('status'=>1));
            $this->data['page_title']       = "Member Registration Form | Khyber CCI";
            $this->data['page_header']      = "Member Registration Form";
            $this->data['page_name']        = "AdminPanel/Members/admin_member_reg_v";
            $this->load->view('AppTemplate/common',$this->data);
         }
    public function admin_home_events(){

        
        
        
        
     if($this->input->post('addAdminNews')):

                $title        = $this->input->post('title');
                $date         = $this->input->post('date');
                $total_days   = $this->input->post('total_days');
                $place        = $this->input->post('place');
                $school_name  = $this->input->post('school_name');
                $time         = $this->input->post('time');
                $description  = $this->input->post('description');
                  

                  $this->form_validation->set_rules('title', 'Title Required', 'required');
                  $this->form_validation->set_rules('date', 'Date Required', 'required');
                  $this->form_validation->set_rules('total_days', 'Total Days Required', 'required');
                  $this->form_validation->set_rules('time', 'Time Required', 'required');

                   if ($this->form_validation->run()):
                     $image      = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/events');
                     $file_name  = $image['file_name'];
                     
                     
                    
                 $data =array(
                   'title'              => $title,  
                   'description'        => $description,  
                   'event_days'         => $total_days,  
                   'place'              => $place,  
                   'school_name'        => $school_name,  
                   'image'              => $file_name,  
                   'date_time'          => date('H:i',strtotime($time)),  
                   'create_datetime'    => date('Y-m-d',strtotime($date)),  
                   'create_by'          => $this->userInfo->user_id,  
                 );
               $insert =   $this->CRUDModel->insert('site_events',$data);
                
               $slug =  $this->CRUDModel->slugify($title);
               $sluge_check =   $this->db->get_where('site_events',array('event_slug'=>$slug,'id !='=>$insert))->row();
               $post_slug = ''; 
               if(empty($sluge_check)):
                  $post_slug = $slug;  
                    else:
                  $post_slug = $slug.'-'.date('d-m-Y-H-i-s');  
                endif;
                $this->CRUDModel->update('site_events',array('event_slug'=>$post_slug),array('id'=>$insert));
               
                 redirect('AdminEvents');
         endif;
     endif;
     if($this->input->post('updateNews')):

              $title             = $this->input->post('title');
              $description       = $this->input->post('description');
              $news_date         = $this->input->post('news_date');
              $image_id          = $this->input->post('image_id');
              $status            = $this->input->post('status');


              $this->form_validation->set_rules('title', 'Picture Title', 'required');

               if ($this->form_validation->run()):

                     $image              = $this->CRUDModel->uploadDirectory('file','SiteAssets/images/news');
                     $file_name          = $image['file_name'];

                     if(empty($file_name)):
                         $data =array(
                         'title'         => $title,  
                         'description'   => $description,  
                         'status'        => $status,  
                         'news_date'     => date('Y-m-d',strtotime($news_date)),  
                         'user_id'       =>$this->userInfo->user_id,  
                       );
                          else: 
                         $data =array(

                         'title'         => $title,  
                         'description'   => $description,
                         'image'   => $file_name,
                         'status'        => $status,  
                         'news_date'     => date('Y-m-d',strtotime($news_date)),  
                         'user_id'       => $this->userInfo->user_id, 

                         );
                     endif;
           $this->CRUDModel->update('site_news',$data,array('id'=>$image_id));
             redirect('AdminNews');
     endif;
     endif;
     if($this->input->post('deleteNews')):
         $id = $this->input->post('image_id');
         $this->CRUDModel->deleteid('site_news',array('id'=>$id));
         redirect('AdminEvents');
     endif;    

         $this->data['site_status']      = $this->CRUDModel->dropDown('site_status', '', 'id', 'title',array('status'=>1));
         $this->data['page_title']       = "Admin Events | Al-ASR";
         $this->data['page_header']      = "Admin Events";
         $this->data['page_name']        = "AdminPanel/HomePage/admin_events_v";
         $this->load->view('AppTemplate/common',$this->data);
      }
      
        public function admin_events_show_js(){
                                 
            $gallery= $this->CRUDModel->get_where_result('site_events',array('status'=>1));
             
//            echo '<pre>';print_r($gallery);die;
               if(!empty($gallery)):  
                    
                   
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($gallery).' Products</h3>';
                    
                     echo '<div class="row page-row">';
                    foreach($gallery as $Row):
                          
                            
                                echo '<div class="col-md-3 col-12 text-center">
                                    <div class="album-cover"  style="min-height: 0px !important;">
                                        <a href="javascript:void(0)" id="'.$Row->id.'"  class="updateNews"  data-toggle="modal" data-target="#updateNewsModel"><img class="img-fluid" style="height: 140px;width: 259px;" src="SiteAssets/images/events/'.$Row->image.'" alt="'.$Row->title.'"></a>
                                        <div class="desc" style="padding: 1px !important;">
                                            <h4><small><a  href="javascript:void(0)"  id="'.$Row->id.'" class="updateNews"  data-toggle="modal" data-target="#updateNewsModel" ><strong>'.$Row->title.'</strong></a></small></h4>
                                            <h4><small>'.$Row->description.'</small></h4>
                                             
                                        </div>
                                    </div>
                                </div>';
                      
                      endforeach;
                     echo '</div>';
                
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
                           
                           
                           
                             jQuery('.updateNews').on('click',function(){
                             var news_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateNews',
                                
                                data : {'news_id':news_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateNews').html(result);
 
                                }

                               });

                         });
                            

                         });
                           
                           
                    


                    </script>
                    <?php
            endif;
            
            
          
        }
}




