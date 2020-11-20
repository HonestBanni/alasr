<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class SaleController extends AdminController {
        
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
            $this->load->model('SaleModel');
            }

   
   
   
   
   /*
    * 
    * Sale Dashboard 
    *
    *  
    */
       public function sale_dashboard(){
            
            $this->data['customer']        = $this->CRUDModel->dropDown('pos_customer', 'Select Customer', 'cust_id', 'cust_name',array('cust_status'=>1,'user_company_id'=>$this->userInfo->company_id));
            $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));
            $this->data['page_title']       = "Sale Dashboard | MTS";
            $this->data['page_header']      = "Sale Dashboard";
            $this->data['page_name']        = "POS/sale/saleDashboard_v";
            $this->load->view('AppTemplate/common',$this->data); 
            
        }
       public function sale_product_check(){
            $product_id = $this->input->post('product_id');
            $quantity   = $this->input->post('quantity');
            
            
           $this->db->select('sum(quantity) as total_quantity_stock');
                            $this->db->join('pos_stock_details','pos_stock_details.stock_id=pos_stock.id');  
                            $this->db->group_by('pos_stock_details.prod_id');
                            $this->db->where('pos_stock.stock_date <="'.date('Y-m-d').'"');
 
            $stocks  =     $this->db->get_where('pos_stock',array('pos_stock_details.prod_id'=>$product_id))->row();
            
            
            
                             $this->db->select('sum(quantity) as total_quantity_sale');
                            $this->db->join('pos_sale_details','pos_sale_details.sale_id=pos_sale.id');  
                            $this->db->group_by('pos_sale_details.prod_id');
                            $this->db->where('pos_sale.sale_date <="'.date('Y-m-d').'"');
            $sales  =       $this->db->get_where('pos_sale',array('pos_sale_details.prod_id'=>$product_id))->row();
            
            
            
            $stock_status = $stocks->total_quantity_stock-$sales->total_quantity_sale-$quantity;
            if($stock_status<0):
                $result['stockInfo'] = 0;
                 else:
                    $result['stockInfo'] = 1;
            endif;
//             $result['stockInfo'] = $stocks->total_quantity_stock-$sales->total_quantity_sale;
           
             
             echo json_encode($result);
     
 
            
        }
     public function customer_balance_js(){
       
       $companyname = $this->input->post('customer');
      $result = $this->SaleModel->customer_balance($companyname);

      echo json_encode($result);
   }
     public function save_sale_js(){
       
      $customer        = $this->input->post('customer');
       $orderDate       = $this->input->post('orderDate');
       $payableAmount   = $this->input->post('payableAmount');
       $currentAmount   = $this->input->post('currentAmount');
       $formCode        = $this->input->post('formCode');
       $order_person    = $this->input->post('order_person');
       $phoneNumber    = $this->input->post('phoneNumber');
       
        $data_company = array(
                'pro_customer_id'   => $customer,
                'order_person'      => $order_person,
                'order_number'      => $phoneNumber,
                'sale_date'         => date('Y-m-d',strtotime($orderDate)),
                'sale_type'         => 1,//type 1 = sale, 2 = return
                'user_company_id'   => $this->userInfo->company_id,
                'create_by'         => $this->userInfo->user_id,
                'create_datetime'   => date('Y-m-d H:i:s'),
                );
                 
        $stock_id   =    $this->CRUDModel->insert('pos_sale',$data_company);
        $demo_stock = $this->db->get_where('pos_stock_details_demo',array('formCode'=>$formCode))->result();
        if(!empty($demo_stock)):
            
            foreach($demo_stock as $row):
                $stock_data = array(
                  'sale_id'     => $stock_id,  
                  'prod_id'     => $row->prod_id,  
                  'quantity'    => $row->quantity,  
                  'pur_price'   => $row->pur_price,  
                  'total_amount'=> $row->total_amount,
                  'create_by'        => $this->userInfo->user_id,
                  'saledatetime'  => date('Y-m-d H:i:s'),  
                );
            $this->CRUDModel->insert('pos_sale_details',$stock_data); 
            
            endforeach; 
            $this->CRUDModel->deleteid('pos_stock_details_demo',array('formCode'=>$formCode));
        endif;
         
        //Update company Balance 
           $balance_update = array(
                  'stock_id'        => $stock_id,  
                  'pro_customer_id'  => $customer,  
                  'total_amount'    => $currentAmount,  
                  'paid_amount'     => $payableAmount,  
                  'paidDate'        => date('Y-m-d',strtotime($orderDate)),  
                  'create_by'        => $this->userInfo->user_id,
                  'create_datetime'  => date('Y-m-d H:i:s'),  
                );
            $this->CRUDModel->insert('pos_customer_balance',$balance_update); 
       
   }  
   
   public function sale_update_report(){
       
        $this->data['customer']        = $this->CRUDModel->dropDown('pos_customer', 'Select Customer', 'cust_id', 'cust_name',array('cust_status'=>1,'user_company_id'=>$this->userInfo->company_id));
        $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));
        $this->data['page_title']       = "Sale Dashboard | MTS";
        $this->data['page_header']      = "Sale Dashboard";
        $this->data['page_name']        = "POS/sale/saleDashboard_v";
        $this->load->view('AppTemplate/common',$this->data);
   }
}
?>