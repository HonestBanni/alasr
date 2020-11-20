<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class PosController extends AdminController {
        
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

            public $userinfo = '';
          public function __construct(){
             parent::__construct();
             ob_start();
             $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
            $this->load->model('PosModel');
            $this->load->model('ReportModel');
            }
        public function stock_dashboard(){
            
            $this->data['companies']        = $this->CRUDModel->dropDown('pos_companies', 'Select Company', 'comp_id', 'comp_name',array('comp_status'=>1,'user_company_id'=>$this->userInfo->company_id));
            $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));
            $this->data['page_title']       = "Stock Dashboard | MTS";
            $this->data['page_header']      = "Stock Dashboard";
            $this->data['page_name']        = "POS/stock/stockDashboard_v";
            $this->load->view('AppTemplate/common',$this->data); 
            
        }
        public function stock_product_info(){
            
            $product_id = $this->input->post('product_id');
            
            if($product_id):
                
                $result['product_info'] = $this->db->get_where('pos_products',array('pro_id'=>$product_id))->row();
                 echo json_encode($result);
            endif;
        }
       public function add_demo_product_js(){
            
             if($this->input->post()):
                 
                 $form_code         = $this->input->post('formCode');
                 $purchasePrice     = $this->input->post('purchasePrice');
                 $quantity          = $this->input->post('quantity');
                 $product_id        = $this->input->post('product_id');
                 
                 
                 $data = array(
                     'formCode'         => $form_code,
                     'prod_id'          => $product_id,
                     'quantity'         => $quantity,
                     'pur_price'        => $purchasePrice,
                     'total_amount'     => $purchasePrice*$quantity,
                     'create_by'        => $this->userInfo->user_id,
                     'create_datetime'  => date('Y-m-d H:i:s'),
                 );
                 
               $this->CRUDModel->insert('pos_stock_details_demo',$data);
                
                 else:
                 redirect('Dashboard');
             endif;
        }
        public function show_demo_product_js(){
            
             if($this->input->post()):
                 
                 $form_code         = $this->input->post('formCode');
                            
                 $result = $this->PosModel->show_demo_product(array('formCode'=> $form_code));
                 if($result):
                     
                
                 
                 echo ' <div class="table-responsive">
                            <table class="table table-hover" id="table">
                            <thead>
                                <tr>
                                    <th>Sn</th>
                                    <th>Product</th>
                                    <th>Quantity</th>
                                    <th>Purchase Price</th>
                                    <th>Total</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>';
                    $sn         = '';
                    $gTotal     = '';
                    foreach($result as $row):
                        $sn++;
                        echo '<tr>';
                        echo '<td>'.$sn.'</td>';
                        echo '<td>'.$row->pro_name.'</td>';
                        echo '<td>'.$row->quantity.'</td>';
                        echo '<td>'.$row->pur_price.'</td>';
                        echo '<td>'.$row->total_amount.'</td>';
                        echo '<td><button id="'.$row->id.'" class="deleteDemoPro"><span class="fa fa-trash text-danger"></span></button></td>';
                        echo '</tr>';
                        $gTotal +=$row->total_amount;
                    endforeach;
                    
                        echo '<tr>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td></td>';
                        echo '<td>Total</td>';
                        echo '<td>'.$gTotal.'</td>';
                        echo '<td></td>';
                        echo '</tr>';
                        
                   echo  '</table>';
                   echo '<input type="hidden" id="gTotal" value="'.$gTotal.'">';
                   echo  '</div>';
                   ?>
                       <script>
                    jQuery(document).ready(function(){
                            //Delete Product 
                            jQuery('.deleteDemoPro').on('click',function(){
                                if (!confirm("Do you want to delete")){
                                    return false;
                                  }
                               var id = jQuery(this).attr('id');
                               var formCode = jQuery('#formCode').val();
                               
                                jQuery.ajax({
                                    type:'post',
                                    url : 'deleteDemoPro',
                                    data: {'pro_id':id},
                                    success:function(result){
                                           jQuery.ajax({
                                            type:'post',
                                            url : 'showProductDemo',
                            
                                            data : {'formCode': formCode},
                                            success:function(results){
                                              jQuery('#show_demo_products').html(results);  
                                              var gTotal = jQuery('#gTotal').val();
                                              var CompanyBalance = jQuery('#CompanyBalance').val();
                                                jQuery("#currentAmount").val(parseInt(gTotal));
                                                jQuery("#totalAmount").val(parseInt(gTotal)+parseInt(CompanyBalance));
                                               
                                            }  
                                        });
                                         
                                    }

                                   })
                           });
                    });


                    </script> 
                       <?php
                   endif;
                  
                 else:
                 redirect('Dashboard');
             endif;
        }
        
   public function delete_demo_product_js(){
       
       $demo_pro_id = $this->input->post('pro_id');
       $this->CRUDModel->deleteid('pos_stock_details_demo',array('id'=>$demo_pro_id));
   }   
   public function company_balance_js(){
       
       $companyname = $this->input->post('companyname');
      $result = $this->PosModel->company_balance(array('pro_company_id'=>$companyname));

      echo json_encode($result);
   }   
   public function save_stock_js(){
       
       $companyname     = $this->input->post('companyname');
       $orderDate       = $this->input->post('orderDate');
       $payableAmount   = $this->input->post('payableAmount');
       $currentAmount   = $this->input->post('currentAmount');
       $formCode        = $this->input->post('formCode');
       
        $data_company = array(
                     'pro_company_id'   => $companyname,
                     'stock_date'       => date('Y-m-d',strtotime($orderDate)),
                     'stock_type'       => 1,
                     'user_company_id'  => $this->userInfo->company_id,
                     'create_by'        => $this->userInfo->user_id,
                     'create_datetime'  => date('Y-m-d H:i:s'),
                 );
                 
            $stock_id =    $this->CRUDModel->insert('pos_stock',$data_company);
        $demo_stock = $this->db->get_where('pos_stock_details_demo',array('formCode'=>$formCode))->result();
        if(!empty($demo_stock)):
            
            foreach($demo_stock as $row):
                $stock_data = array(
                  'stock_id'=>$stock_id,  
                  'prod_id'=>$row->prod_id,  
                  'quantity'=>$row->quantity,  
                  'pur_price'=>$row->pur_price,  
                  'total_amount'=>$row->total_amount,  
                );
            $this->CRUDModel->insert('pos_stock_details',$stock_data); 
            
            endforeach; 
            $this->CRUDModel->deleteid('pos_stock_details_demo',array('formCode'=>$formCode));
        endif;
         
        //Update company Balance 
           $balance_update = array(
                  'stock_id'        => $stock_id,  
                  'pro_company_id'  => $companyname,  
                  'total_amount'    => $currentAmount,  
                  'paid_amount'     => $payableAmount,  
                  'paidDate'        => date('Y-m-d',strtotime($orderDate)),  
                  'create_by'        => $this->userInfo->user_id,
                  'create_datetime'  => date('Y-m-d H:i:s'),  
                );
            $this->CRUDModel->insert('pos_company_balance',$balance_update); 
       
   }   
 
   public function stock_update_report(){
            
             
            $this->data['fromDate']         = date('d-m-Y');
            $this->data['toDate']           = date('d-m-Y');
            
            $date['fromDate']           = date('d-m-Y');
            $date['toDate']             = date('d-m-Y');
               
            

            if($this->input->post('search')):
                $fromDate                   = $this->input->post('fromDate');
                $toDate                     = $this->input->post('toDate');
                $date['fromDate']           = $fromDate;
                $this->data['fromDate']     = $fromDate;
                $date['toDate']             = $toDate;
                $this->data['toDate']       = $toDate;
                

                $this->data['result'] = $this->ReportModel->stock_update_report($date);
        //        echo '<pre>';print_r($this->data['result']);die;
            endif;
            $this->data['result'] = $this->ReportModel->stock_update_report($date);
            $this->data['page_title']       = "Stock Invoice Update | MTS";
            $this->data['page_header']      = "Stock Invoice Update";
            $this->data['page_name']        = "POS/stock/stock_invoice_update_v";
            $this->load->view('AppTemplate/common',$this->data); 
            
        }
    public function update_stock_invoice(){
            
            $stock_invoice_id       = $this->uri->segment(2);
            $stock_invoice          = $this->db->get_where('pos_stock',array('id'=>$stock_invoice_id))->row();
            $stock_invoice_details  = $this->db->get_where('pos_stock_details',array('stock_id'=>$stock_invoice_id))->result();
            
            $formCode                = date(strtotime($stock_invoice->create_datetime)).date('YmdHis');
            
            $this->CRUDModel->deleteid('pos_stock_details_demo',array('stock_id'=>$stock_invoice_id));
            $this->CRUDModel->deleteid('pos_stock_details_demo',array('stock_id'=>0));
                foreach($stock_invoice_details as $row):
                 $data = array(
                   'formCode'       => $formCode, 
                   'stock_id'       => $row->stock_id, 
                   'prod_id'        => $row->prod_id, 
                   'quantity'       => $row->quantity, 
                   'pur_price'      => $row->pur_price, 
                   'total_amount'   => $row->total_amount, 
                 );
             $this->CRUDModel->insert('pos_stock_details_demo',$data);
             endforeach;   
              
            $this->data['formCode']         = $formCode;
            $this->data['stock_invoice']    = $stock_invoice;
            $this->data['companies']        = $this->CRUDModel->dropDown('pos_companies', 'Select Company', 'comp_id', 'comp_name',array('comp_status'=>1,'user_company_id'=>$this->userInfo->company_id));
            $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));
            $this->data['page_title']       = "Stock Dashboard | MTS";
            $this->data['page_header']      = "Stock Dashboard";
            $this->data['page_name']        = "POS/stock/stock_dashboard_update_v";
            $this->load->view('AppTemplate/common',$this->data); 
            
        }
       public function update_stock_date_js(){
       
       $companyname     = $this->input->post('companyname');
       $orderDate       = $this->input->post('orderDate');
       $payableAmount   = $this->input->post('payableAmount');
       $currentAmount   = $this->input->post('currentAmount');
       $formCode        = $this->input->post('formCode');
       $stock_id        = $this->input->post('stock_id');
       
        $data_company = array(
                     'pro_company_id'   => $companyname,
                     'stock_date'       => date('Y-m-d',strtotime($orderDate)),
                     'stock_type'       => 1,
                     'user_company_id'  => $this->userInfo->company_id,
                     'update_by'        => $this->userInfo->user_id,
                     'update_datetime'  => date('Y-m-d H:i:s'),
                 );
                 
            $this->CRUDModel->update('pos_stock',$data_company,array('id'=>$stock_id));
        $demo_stock = $this->db->get_where('pos_stock_details_demo',array('formCode'=>$formCode))->result();
        if(!empty($demo_stock)):
             $this->CRUDModel->deleteid('pos_stock_details',array('stock_id'=>$stock_id));
             foreach($demo_stock as $row):
                $stock_data = array(
                  'stock_id'=>$stock_id,  
                  'prod_id'=>$row->prod_id,  
                  'quantity'=>$row->quantity,  
                  'pur_price'=>$row->pur_price,  
                  'total_amount'=>$row->total_amount,  
                );
            $this->CRUDModel->insert('pos_stock_details',$stock_data); 
             endforeach; 
            $this->CRUDModel->deleteid('pos_stock_details_demo',array('formCode'=>$formCode));
        endif;
         
        //Update company Balance 
           $balance_update = array(
                    
                  'pro_company_id'  => $companyname,  
                  'total_amount'    => $currentAmount,  
                  'paid_amount'     => $payableAmount,  
                  'paidDate'        => date('Y-m-d',strtotime($orderDate)),  
                  'update_by'       => $this->userInfo->user_id,
                  'update_datetime' => date('Y-m-d H:i:s'),  
                );
            $this->CRUDModel->update('pos_company_balance',$balance_update,array('stock_id'=> $stock_id)); 
    } 
    public function delete_stock_invoice_js(){
       
       $stock_id = $this->input->post('stock_id');
       $this->CRUDModel->deleteid('pos_stock_details',array('stock_id'=>$stock_id));
       $this->CRUDModel->deleteid('pos_stock',array('id'=>$stock_id));
       $this->CRUDModel->deleteid('pos_company_balance',array('stock_id'=>$stock_id));
       
   }
}
?>