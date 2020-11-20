<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
class ProductController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
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
                $this->load->model('ProductModel');
                $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);

        }
    public function register_product_company(){
             
            $this->data['companies']        = $this->CRUDModel->dropDown('pos_companies', 'Select Company', 'comp_id', 'comp_name',array('comp_status'=>1));
            $this->data['page_title']       = "Register Product Company";
            $this->data['page_header']      = "Register Product Company";
            $this->data['page_name']        = "POS/setups/reg_product_company_v";
            $this->load->view('AppTemplate/common',$this->data); 
            
        }
    public function register_company_show_js(){
            $where                 = array('user_company_id'=>$this->userInfo->company_id);
            $company_show_20       = $this->ProductModel->company_show_20($where);
             
            $all_companies          = count($this->ProductModel->company_show_search($where));
            
               if(!empty($all_companies)):  
                    
                  if($all_companies >= 20):
                     
                       
                  echo '<h3 class="has-divider text-highlight">Last '.count($company_show_20).' Products Of '.$all_companies.'</h3>';
                     else:
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($company_show_20).' Products</h3>';
                 endif;
        
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Product Company Name</th>
                                    <th>Address</th>
                                    <th>Phone No</th>
                                    <th>User Company</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($company_show_20 as $Row):
                         echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->comp_name.'</td>
                                    <td>'.$Row->comp_address.'</td>
                                    <td>'.$Row->comp_phone.'</td>
                                    <td>'.$Row->title.'</td>    
                                     
                                    <td>
                                         <button    id="'.$Row->comp_id.'"  class="updateCompanyData" data-toggle="modal" data-target="#updateCompany"><span class="fa fa-book text-success"></span></button>';
                                         if($Row->comp_status ==1):
                                             echo '<button    id="'.$Row->comp_id.'"  class="deleteCompany"><span class="fa fa-trash text-danger"></span></button>';
                                        endif;
                            echo    '</td>
                                </tr>';
                        $sn++;
                      endforeach;
                    
               
                 echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                         
                            //Delete Product 
                            jQuery('.deleteCompany').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteCompany',
                                    data: {'pro_id':id},
                                    success:function(result){
                                         jQuery.ajax({
                                            type:'post',
                                            url : 'RegCompanyShow',
                                            success:function(result){
                                                jQuery('#company_show_js').html(result);

                                            }

                                           });
                                         
                                    }

                                   });
                           });
                            jQuery('.updateCompanyData').on('click',function(){
                            var comp_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateCompany',
                                data : {'company_id':comp_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateCompany').html(result);
 
                                }

                               });

                         });
                           
                           
                    });


                    </script>
                    <?php
                 
                 
                 
             endif;
        }
    public function update_company_js(){
       $company_id      = $this->input->post('company_id'); 
       $company_info    = $this->db->get_where('pos_companies',array('comp_id'=>$company_id))->row();
       $status          = $this->CRUDModel->dropDown('pos_products_status', 'Select Status', 'id', 'type_title',array('status'=>1));
 
        
       if($company_info):
            
             
           
            echo '<form action="UpdateCompany" class="form-horizontal" id="RegUpdateCompany" method="post" accept-charset="utf-8">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
                    
                     
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Company Name  </label>
                        <input type="text" name="uname" value="'.$company_info->comp_name.'" id="uname" class="form-control" placeholder="Company Name  ">

                    </div>
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Address </label>
                        <input type="text" name="uaddress" value="'.$company_info->comp_address.'" id="address" class="form-control" placeholder="Address ">

                    </div>
            
                     
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Phone No</label>
                        <input type="text" name="uphone_no" value="'.$company_info->comp_phone.'" id="phone_no" class="form-control" placeholder="Phone no ">
                        <input type="hidden" name="company_id" value="'.$company_info->comp_id.'" id="phone_no" class="form-control">

                    </div>
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Status</label>';
                            
                            echo form_dropdown('status', $status,$company_info->comp_status,  'class="form-control" id="status"');
                                
                    echo '</div>
            </div>
            <div class="col-md-12" id="error_message">
                     <br>
                     <strong class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;Please Fill All Required Field (*)</strong>
                </div>
          </div>

     
      </div>
      <div class="modal-footer">
          <button type="button" id="updateCompanyData" value="updateCompanyData" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
                    
                 ?>
                    <script>
                    jQuery(document).ready(function(){
                    jQuery('#updateCompanyData').on('click',function(){
                                
                        jQuery.ajax({
                            type:'post',
                            url : 'UpdateCompanyData',
                            data: jQuery('#RegUpdateCompany').serialize(),
                            success:function(result){
                                 alert('Record update successfully...');
                            jQuery('#updateCompany').modal('toggle');
                            jQuery.ajax({
                                type:'post',
                                url : 'RegCompanyShowSearch',
                                data: {'search_query':jQuery('#SearchCompany').val()},
                                success:function(result){
                                    jQuery('#company_show_js').html(result);
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
    public function update_company_data(){
           
        if($this->input->post()):
            $data = array(
              'comp_name'       => $this->input->post('uname'),  
              'comp_address'    => $this->input->post('uaddress'),  
              'comp_phone'      => $this->input->post('uphone_no'),  
              'comp_status'     => $this->input->post('status'),  
              'update_by'       => $this->userInfo->user_id,  
              'update_datetime' => date('Y-m-d H:i:s'),  
                
            );
            $where = array(
              'comp_id'=>$this->input->post('company_id') 
            );  
            
            $this->CRUDModel->update('pos_companies',$data,$where);
        endif;
        
         
    }
    public function register_company_show_search_js(){
            $like                       = $this->input->post('search_query');
            $where                      = array('user_company_id'=>$this->userInfo->company_id);
            $company_show_20            = $this->ProductModel->company_show_search($where,$like);
//            echo '<pre>';print_r($company_show_20);die;
            $all_companies                = count($this->ProductModel->company_show_search());
               if($company_show_20):  
                 if(count($company_show_20)>20):
                     echo '<h3 class="has-divider text-highlight">Search 20 products from '.$all_companies.'  </h3>';
                     else:
                     echo '<h3 class="has-divider text-highlight">Search '.count($company_show_20).' products from '.$all_companies.'</h3>';
                 endif;
                
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Product Company Name</th>
                                    <th>Address</th>
                                    <th>Phone No</th>
                                    <th>User Company</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($company_show_20 as $Row):
                            echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->comp_name.'</td>
                                    <td>'.$Row->comp_address.'</td>
                                    <td>'.$Row->comp_phone.'</td>
                                    <td>'.$Row->title.'</td>    
                                     
                                       
                                    <td>
                                         <button    id="'.$Row->comp_id.'"  class="updateCompanyData" data-toggle="modal" data-target="#updateCompany"><span class="fa fa-book text-success"></span></button>';
                                         if($Row->comp_status ==1):
                                             echo '<button    id="'.$Row->comp_id.'"  class="deleteCompany"><span class="fa fa-trash text-danger"></span></button>';
                                        endif;
                            echo    '</td>
                                </tr>';
                        $sn++;
                      endforeach;
                echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                            //Delete Product 
                            jQuery('.deleteCompany').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteCompany',
                                    data: {'pro_id':id},
                                    success:function(result1){
                                         jQuery.ajax({
                                            type:'post',
                                            url : 'RegCompanyShowSearch',
                                            data: {'search_query':jQuery('#SearchCompany').val()},
                                            success:function(result){
                                                jQuery('#company_show_js').html(result);
                                                }
                                            });
                                         
                                    }

                                   });
                           });
                           
                                jQuery('.updateCompanyData').on('click',function(){
                            var comp_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateCompany',
                                data : {'company_id':comp_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateCompany').html(result);
 
                                }

                               });

                         });
                    });


                    </script>
                    <?php
             endif;
        } 
    public function add_company_js(){
       
        $name           = $this->input->post('name');
        $address        = $this->input->post('address');
        $phone_no       = $this->input->post('phone_no');

        $this->form_validation->set_rules('name', 'Product Name', 'required|is_unique[pos_companies.comp_name]');
        if ($this->form_validation->run() == FALSE):
             echo false;
             else:
                 $data = array(
                    'comp_name'         => $name,
                    'comp_address'      => $address,
                    'comp_phone'        => $phone_no,
                    'create_by'         =>  $this->userInfo->user_id,
                    'user_company_id'   =>  $this->userInfo->company_id,
                    'comp_reg_date'     =>  date('Y-m-d H:i:s'),
                );

                $this->CRUDModel->insert('pos_companies',$data);
                echo  true;

         endif;  
     }   
    public function delete_company_js(){
       $pro_id = $this->input->post('pro_id');
        //Product status 3 = Trash
        $this->CRUDModel->update('pos_companies',array('comp_status'=>3),array('comp_id'=>$pro_id));
    }

    public function product(){

         if($this->input->post()):

         endif;
        $this->data['companies']        = $this->CRUDModel->dropDown('pos_companies', 'Select Company', 'comp_id', 'comp_name',array('comp_status'=>1));
        $this->data['page_title']       = "Register Product";
        $this->data['page_header']      = "Register Product";
        $this->data['page_name']        = "POS/setups/products_v";
        $this->load->view('AppTemplate/common',$this->data); 

    }
    public function product_show_js(){
        $where                 = array('pos_products.user_company_id'=>$this->userInfo->company_id);
        $product_show_20       = $this->ProductModel->product_show_20($where);
        $all_product           = count($this->ProductModel->product_show_search($where));

           if(!empty($all_product)):  

              if($all_product >= 20):


              echo '<h3 class="has-divider text-highlight">Last '.count($product_show_20).' Products Of '.$all_product.'</h3>';
                 else:

                 echo '<h3 class="has-divider text-highlight">Last '.count($product_show_20).' Products</h3>';
             endif;

             echo ' <div class="table-responsive">
                        <table class="table table-hover" id="table" >
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Name</th>
                                <th>Purchase Price</th>
                                <th>Product Company</th>
                                <th>Reg Date</th>
                                <th>User Company</th>
                                <th>Manage</th>
                            </tr>
                            </thead>
                        ';


             

                $sn = 1;
                foreach($product_show_20 as $Row):
                     echo '  <tr class="gradeX">
                                <td>'.$sn.'</td>
                                <td>'.$Row->pro_name.'</td>
                                <td>'.$Row->pro_sal_price.'</td>
                                <td>'.$Row->comp_name.'</td>
                                <td>'.date('d-M-Y',strtotime($Row->create_datetime)).'</td>
                                <td>'.$Row->title.'</td>    

                                <td>';
                                    echo '<button    id="'.$Row->pro_id.'"  class="updateProductData" data-toggle="modal" data-target="#updateProduct"><span class="fa fa-book text-success"></span></button>';
                                    
                                    if($Row->pro_status ==1):
                                         
                                        echo '<button  id="'.$Row->pro_id.'" class="deleteProduct" "><span class="fa fa-trash text-danger"></span></button>';
                              
                                    endif;
                                    
                 echo ' </td>
                            </tr>';
                    $sn++;
                  endforeach;


             echo '</table>';
              ?>
                <script>
                jQuery(document).ready(function(){
                        //Delete Product 
                        jQuery('.deleteProduct').on('click',function(){

                            if (!confirm("Do you want to delete")){
                                return false;
                              }
                           var id = jQuery(this).attr('id');

                            jQuery.ajax({
                                type:'post',
                                url : 'DeleteProducts',
                                data: {'pro_id':id},
                                success:function(result){
                                    
                                     jQuery.ajax({
                                        type:'post',
                                        url : 'ProductShow',
                                        success:function(result){
                                            jQuery('#product_show_js').html(result);

                                        }

                                       });

                                }

                               });
                       });
                       
                        jQuery('.updateProductData').on('click',function(){
                            var product_id = this.id;
                             
                             jQuery.ajax({
                              
                                type:'post',
                                url : 'UpdateProduct',
                                data : {'product_id':product_id},
                                success:function(result){
                                    
                                    jQuery('#show_updateProduct').html(result);

                                }

                               });

                         });
                       
                });
                

                </script>
                <?php



         endif;
    }
    public function update_product_js(){
       $product_id      = $this->input->post('product_id'); 
       $product_info    = $this->db->get_where('pos_products',array('pro_id'=>$product_id))->row();
       $comp_info       = $this->CRUDModel->dropDown('pos_companies', 'Select Company', 'comp_id', 'comp_name',array('comp_status'=>1));
       $status          = $this->CRUDModel->dropDown('pos_products_status', 'Select Status', 'id', 'type_title',array('status'=>1));
        
       if($product_info):
            
             
           
            echo '<form action="RegUpdateProduct" class="form-horizontal" id="RegUpdateProduct" method="post" accept-charset="utf-8">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
                    
                     
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Product Name  </label>
                        <input type="text" name="proname" value="'.$product_info->pro_name.'" id="uname" class="form-control" placeholder="Company Name  ">

                    </div>
                  
                    <div class="col-md-4 col-sm-5">
                        <label for="name">Product Company</label>';
                            
                            echo form_dropdown('company_id', $comp_info,$product_info->pro_compId,  'class="form-control" id="status"');
                                
                    echo '</div>
                           <div class="col-md-4 col-sm-5">
                        <label for="name">Purchase Price </label>
                        <input type="text" name="purchasePrice" value="'.$product_info->pro_sal_price.'" id="address" class="form-control" placeholder="Address ">

                    </div>
            
                     
                    <div class="col-md-4 col-sm-5">
                            <label for="name">Show Alert Minimum stock *</label>
                        <input type="text" name="minstock" value="'.$product_info->pro_min_stock.'" id="phone_no" class="form-control" placeholder="Phone no ">
                        <input type="hidden" name="pro_id" value="'.$product_info->pro_id.'" id="pro_id" class="form-control">

                    </div>
                    <div class="col-md-4 col-sm-5">
                            <label for="name">Status</label>';
                         echo form_dropdown('status', $status,$product_info->pro_status,  'class="form-control" id="status"');
                              
                    echo '</div>
            </div>
            <div class="col-md-12" id="error_message">
                     <br>
                     <strong class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;Please Fill All Required Field (*)</strong>
                </div>
          </div>

     
      </div>
      <div class="modal-footer">
          <button type="button" id="updateProductData" value="updateProductData" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
                    
                 ?>
                    <script>
                    jQuery(document).ready(function(){
                    jQuery('#updateProductData').on('click',function(){
                                
                        jQuery.ajax({
                            type:'post',
                            url : 'UpdateProductData',
                            data: jQuery('#RegUpdateProduct').serialize(),
                            success:function(result){
                             alert('Record update successfully...');   
                            jQuery('#updateProduct').modal('toggle');
                            
                            
                               jQuery.ajax({
                                type:'post',
                                url : 'ProductShowSearch',
                                data: {'search_query':jQuery('#SearchProduct').val()},
                                success:function(result){
                                    jQuery('#product_show_js').html(result);

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
    public function update_product_data(){
           
        if($this->input->post()):
           
            $data = array(
              'pro_name'        => $this->input->post('proname'),  
              'pro_compId'      => $this->input->post('company_id'),  
              'pro_min_stock'   => $this->input->post('minstock'),  
              'pro_sal_price'   => $this->input->post('purchasePrice'),  
              'pro_status'      => $this->input->post('status'),  
              'update_by'       => $this->userInfo->user_id,  
              'update_datetime' => date('Y-m-d H:i:s'),  
                
            );
            $where = array(
              'pro_id'=>$this->input->post('pro_id') 
            );  
            
            $this->CRUDModel->update('pos_products',$data,$where);
        endif;
        
         
    }
    public function product_show_search_js(){
        $like = $this->input->post('search_query');
        $where = array('pos_products.user_company_id'=>$this->userInfo->company_id);
        $product_show_20       = $this->ProductModel->product_show_search($where,$like);
        $all_product           = count($this->ProductModel->product_show_search());
           if($product_show_20):  
             if(count($product_show_20)>20):
                 echo '<h3 class="has-divider text-highlight">Search 20 products from '.$all_product.'  </h3>';
                 else:
                 echo '<h3 class="has-divider text-highlight">Search '.count($product_show_20).' products from '.$all_product.'</h3>';
             endif;

             echo ' <div class="table-responsive">
                        <table class="table table-hover" id="table" >
                        <thead>
                            <tr>
                                <th>Sn</th>
                                <th>Name</th>
                                <th>Purchase Price</th>
                                <th>Product Company</th>
                                <th>Reg Date</th>
                                <th>User Company</th>

                                <th>Manage</th>
                            </tr>
                            </thead>
                        ';



                $sn = 1;
                foreach($product_show_20 as $Row):
                        echo '  <tr class="gradeX">
                               <td>'.$sn.'</td>
                                <td>'.$Row->pro_name.'</td>
                                <td>'.$Row->pro_sal_price.'</td>
                                <td>'.$Row->comp_name.'</td>
                                <td>'.date('d-M-Y',strtotime($Row->create_datetime)).'</td>
                                <td>'.$Row->title.'</td>    

                                <td>';
                                    echo '<button    id="'.$Row->pro_id.'"  class="updateProductData" data-toggle="modal" data-target="#updateProduct"><span class="fa fa-book text-success"></span></button>';
                                    
                                    if($Row->pro_status ==1):
                                         
                                        echo '<button  id="'.$Row->pro_id.'" class="deleteProduct" "><span class="fa fa-trash text-danger"></span></button>';
                              
                                    endif;
                                    
                 echo ' </td>
                            </tr>';
                    $sn++;
                  endforeach;


             echo '</table>';
             ?>
                <script>
                jQuery(document).ready(function(){
                        //Delete Product 
                        jQuery('.deleteProduct').on('click',function(){

                            if (!confirm("Do you want to delete")){
                                return false;
                              }
                           var id = jQuery(this).attr('id');

                            jQuery.ajax({
                                type:'post',
                                url : 'DeleteProducts',
                                data: {'pro_id':id},
                                success:function(result){
                                    jQuery.ajax({
                                        type:'post',
                                        url : 'ProductShowSearch',
                                        data: {'search_query':jQuery('#SearchProduct').val()},
                                        success:function(result){
                                            jQuery('#product_show_js').html(result);

                                        }
                                    });
                       }
                });
                });
                  jQuery('.updateProductData').on('click',function(){
                            var product_id = this.id;
                             jQuery.ajax({
                                type:'post',
                                url : 'UpdateProduct',
                                data : {'product_id':product_id},
                                success:function(result){
                                    jQuery('#show_updateProduct').html(result);
                                    }
                                });
                            });
                });


                </script>
                <?php
         endif;
    }
    public function register_products_js(){


        $productName    = $this->input->post('product_name');
        $companyname    = $this->input->post('companyname');
        $mine_stock     = $this->input->post('mine_stock');
        $saleprice      = $this->input->post('sale_price');


    //            $this->load->library('form_validation');
        $this->form_validation->set_rules('product_name', 'Product Name', 'required|is_unique[pos_products.pro_name]');
        $this->form_validation->set_rules('sale_price', 'Sale Price', 'required');
        $this->form_validation->set_rules('companyname', 'Sale Price', 'required');

         if ($this->form_validation->run() == FALSE):
             echo false;
             else:
                 $data = array(
                    'pro_name'          => $productName,
                    'pro_min_stock'     => $mine_stock,
                    'pro_sal_price'     => $saleprice,
                    'pro_compId'        => $companyname,
                    'create_by'         =>  $this->userInfo->user_id,
                    'user_company_id'   =>  $this->userInfo->company_id,
                    'create_datetime'   =>  date('Y-m-d H:i:s'),
                );

                $id = $this->CRUDModel->insert('pos_products',$data);
                  echo  true;

         endif;



    }
    public function delete_products_js(){
       $pro_id = $this->input->post('pro_id');
        //Product status 3 = Trash
        $this->CRUDModel->update('pos_products',array('pro_status'=>3),array('pro_id'=>$pro_id));
}


    public function register_customer(){
        $this->data['page_title']       = "Register Customer";
        $this->data['page_header']      = "Register Customer";
        $this->data['page_name']        = "POS/setups/reg_customer_v";
        $this->load->view('AppTemplate/common',$this->data); 
            
    }
      public function add_customer_js(){
       
        $name           = $this->input->post('name');
        $address        = $this->input->post('address');
        $phone_no       = $this->input->post('phone_no');

        $this->form_validation->set_rules('name', 'Customer Name', 'required|is_unique[pos_customer.cust_name]');
        if ($this->form_validation->run() == FALSE):
             echo false;
             else:
                 $data = array(
                    'cust_name'         => $name,
                    'cust_address'      => $address,
                    'cust_phone'        => $phone_no,
                    'create_by'         =>  $this->userInfo->user_id,
                    'user_company_id'   =>  $this->userInfo->company_id,
                    'cust_reg_date'     =>  date('Y-m-d H:i:s'),
                );

                $this->CRUDModel->insert('pos_customer',$data);
                echo  true;

         endif;  
     } 
    public function register_customer_show_js(){
            $where                 = array('user_company_id'=>$this->userInfo->company_id);
            $company_show_20       = $this->ProductModel->customer_show_20($where);
            $all_companies          = count($this->ProductModel->customer_show_search($where));
                if(!empty($all_companies)):  
                    
                  if($all_companies >= 20):
                     
                       
                  echo '<h3 class="has-divider text-highlight">Last '.count($company_show_20).' Products Of '.$all_companies.'</h3>';
                     else:
                       
                     echo '<h3 class="has-divider text-highlight">Last '.count($company_show_20).' Products</h3>';
                 endif;
        
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Customer Name</th>
                                    <th>Address</th>
                                    <th>Phone No</th>
                                    <th>User Company</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($company_show_20 as $Row):
                         echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->cust_name.'</td>
                                    <td>'.$Row->cust_address.'</td>
                                    <td>'.$Row->cust_phone.'</td>
                                    <td>'.$Row->title.'</td>  
                                    <td>
                                    <button    id="'.$Row->cust_id.'"  class="updateCustomerData" data-toggle="modal" data-target="#updateCustomer"><span class="fa fa-book text-success"></span></button>';
                                    if($Row->cust_status == 1):
                                            echo '<button  id="'.$Row->cust_id.'" class="deleteCompany" "><span class="fa fa-trash text-danger"></span></button>';
                                     
                                    endif;
                                    echo '</td>
                                </tr>';
                        $sn++;
                      endforeach;
                    
               
                 echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                            //Delete Product 
                            jQuery('.DeleteCustomer').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteCustomer',
                                    data: {'id':id},
                                    success:function(result){
                                            jQuery.ajax({
                                                type:'post',
                                                url : 'RegCustomerShow',
                                                success:function(result){
                                                    jQuery('#customer_show_js').html(result);
                                                }
                                                });
                                            }
                                        });
                           });
                           
                             jQuery('.updateCustomerData').on('click',function(){
                            var customer_id = this.id;
                             jQuery.ajax({
                                type:'post',
                                url : 'UpdateCustomer',
                                data : {'customer_id':customer_id},
                                success:function(result){
                                    jQuery('#show_updateCustomer').html(result);
                                    }
                                });
                            });
                           
                           
                    });


                    </script>
                    <?php
                 
                 
                 
             endif;
        } 
    public function delete_customer_js(){
       $id = $this->input->post('id');
        //Product status 3 = Trash
        $this->CRUDModel->update('pos_customer',array('cust_status'=>3),array('cust_id'=>$id));
    }   
    public function register_customer_show_search_js(){
            $like                       = $this->input->post('search_query');
            $where                      = array('user_company_id'=>$this->userInfo->company_id);
            $company_show_20            = $this->ProductModel->customer_show_search($where,$like);
//            echo '<pre>';print_r($company_show_20);die;
            $all_companies                = count($this->ProductModel->customer_show_search());
               if($company_show_20):  
                 if(count($company_show_20)>20):
                     echo '<h3 class="has-divider text-highlight">Search 20 products from '.$all_companies.'  </h3>';
                     else:
                     echo '<h3 class="has-divider text-highlight">Search '.count($company_show_20).' products from '.$all_companies.'</h3>';
                 endif;
                
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table" >
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Product Company Name</th>
                                    <th>Address</th>
                                    <th>Phone No</th>
                                    <th>User Company</th>
                                    <th>Manage</th>
                                </tr>
                                </thead>
                            ';
             
                 
                         
                    $sn = 1;
                    foreach($company_show_20 as $Row):
                            echo '  <tr class="gradeX">
                                    <td>'.$sn.'</td>
                                    <td>'.$Row->cust_name.'</td>
                                    <td>'.$Row->cust_address.'</td>
                                    <td>'.$Row->cust_phone.'</td>
                                    <td>'.$Row->title.'</td>    
                                     
                                    <td>
                                    <button    id="'.$Row->cust_id.'"  class="updateCustomerData" data-toggle="modal" data-target="#updateCustomer"><span class="fa fa-book text-success"></span></button>';
                                    if($Row->cust_status == 1):
                                            echo '<button  id="'.$Row->cust_id.'" class="deleteCompany" "><span class="fa fa-trash text-danger"></span></button>';
                                     
                                    endif;
                                    echo '</td>
                                </tr>';
                        $sn++;
                      endforeach;
                echo '</table>';
                  ?>
                    <script>
                    jQuery(document).ready(function(){
                            //Delete Product 
                            jQuery('.deleteCompany').on('click',function(){
                                
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                                
                                jQuery.ajax({
                                    type:'post',
                                    url : 'DeleteCompany',
                                    data: {'pro_id':id},
                                    success:function(result1){
                                         jQuery.ajax({
                                            type:'post',
                                            url : 'RegCompanyShowSearch',
                                            data: {'search_query':jQuery('#SearchCompany').val()},
                                            success:function(result){
                                                jQuery('#company_show_js').html(result);
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
  
    public function update_customer_js(){
        $customer_id      = $this->input->post('customer_id'); 
       $customer_info    = $this->db->get_where('pos_customer',array('cust_id'=>$customer_id))->row();
        $status          = $this->CRUDModel->dropDown('pos_products_status', 'Select Status', 'id', 'type_title',array('status'=>1));
        
       if($customer_info):
            
             
           
            echo '<form action="RegUpdateCustomer" class="form-horizontal" id="RegUpdateCustomer" method="post" accept-charset="utf-8">
      <div class="modal-body">
           <div class="row">
            <div class="col-md-12">
                    
                     
                     <div class="col-md-4 col-sm-5">
                        <label for="name">Customer Name  </label>
                        <input type="text" name="uname" value="'.$customer_info->cust_name.'" id="uname" class="form-control" placeholder="Company Name  ">

                    </div>
                  
                   
                           <div class="col-md-4 col-sm-5">
                        <label for="name">Address </label>
                        <input type="text" name="uaddress" value="'.$customer_info->cust_address.'" id="uaddress" class="form-control" placeholder="Address ">

                    </div>
            
                     
                    <div class="col-md-4 col-sm-5">
                            <label for="name">Phone no</label>
                        <input type="text" name="uphone" value="'.$customer_info->cust_phone.'" id="uphone" class="form-control" placeholder="Phone no ">
                        <input type="hidden" name="cust_id" value="'.$customer_info->cust_id.'" id="cust_id" class="form-control">

                    </div>
                    <div class="col-md-4 col-sm-5">
                            <label for="name">Status</label>';
                         echo form_dropdown('status', $status,$customer_info->cust_status,  'class="form-control" id="status"');
                              
                    echo '</div>
            </div>
            <div class="col-md-12" id="error_message">
                     <br>
                     <strong class="text-danger">&nbsp;&nbsp;&nbsp;&nbsp;Please Fill All Required Field (*)</strong>
                </div>
          </div>

     
      </div>
      <div class="modal-footer">
          <button type="button" id="updateCustomerData" value="updateCustomerData" class="btn btn-theme"> <i class="fa fa-plus"></i> Update</button>
            <button type="button" class="btn btn-theme" data-dismiss="modal">Close</button>
      
      </div>
        </form>';
                    
                 ?>
                    <script>
                    jQuery(document).ready(function(){
                    jQuery('#updateCustomerData').on('click',function(){
                                
                        jQuery.ajax({
                            type:'post',
                            url : 'UpdateCustomerData',
                            data: jQuery('#RegUpdateCustomer').serialize(),
                            success:function(result){
                             alert('Record update successfully...');   
                            jQuery('#updateCustomer').modal('toggle');
                                jQuery.ajax({
                                type:'post',
                                url : 'RegCustomerShowSearch',
                                data: {'search_query':jQuery('#SearchCustomer').val()},
                                success:function(result){
                                    jQuery('#customer_show_js').html(result);
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
    public function update_customer_data(){
           
        if($this->input->post()):
           
            $data = array(
                'cust_name'       => $this->input->post('uname'),  
                'cust_address'    => $this->input->post('uaddress'),  
                'cust_phone'      => $this->input->post('uphone_no'),  
                'cust_status'     => $this->input->post('status'),  
                'update_by'       => $this->userInfo->user_id,  
                'update_datetime' => date('Y-m-d H:i:s'),  
                
            );
            $where = array(
              'cust_id'=>$this->input->post('cust_id') 
            );  
            
            $this->CRUDModel->update('pos_customer',$data,$where);
        endif;
        
         
    } 
     
}




