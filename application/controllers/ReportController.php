<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class ReportController extends AdminController {
        
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
            $this->load->model('ReportModel');
            }
     
   public function stock_report(){
      
    $this->data['company']         = $this->CRUDModel->dropDownName('pos_companies', 'Select Company', 'comp_id', 'comp_name',array('comp_status'=>1,'user_company_id'=>$this->userInfo->company_id));   
    $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));   
    $this->data['productid']        = '';
    $this->data['companyid']        = '';
    $this->data['fromDate']         = date('d-m-Y');
    $this->data['toDate']           = date('d-m-Y');
     
     
    if($this->input->post('search')):
        $fromDate       = $this->input->post('fromDate');
        $toDate         = $this->input->post('toDate');
        $productid      = $this->input->post('products');
        $companyid      = $this->input->post('company');
        
        $where = '';
        $date['fromDate']           = $fromDate;
        $this->data['fromDate']     = $fromDate;
        $date['toDate']             = $toDate;
        $this->data['toDate']       = $toDate;
        
        if($productid):
            $where['prod_id']           = $productid;
            $this->data['productid']    = $productid;
        endif;
        if($companyid):
            $where['pro_compId']           = $companyid;
            $this->data['companyid']    = $companyid;
        endif;
        
        $this->data['result'] = $this->ReportModel->stock_daily_stock_report($where,$date);
//        echo '<pre>';print_r($this->data['result']);die;
    endif;
    
    
    $this->data['page_title']       = "Daily Stock Report | MTS";
    $this->data['page_header']      = "Daily Stock Report";
    $this->data['page_name']        = "POS/reports/stock_report_v";
    $this->load->view('AppTemplate/common',$this->data);
   }
   public function sale_report(){
      
    $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));   
    $this->data['productid']        = '';
    $this->data['fromDate']         = date('d-m-Y');
    $this->data['toDate']           = date('d-m-Y');
     
     
    if($this->input->post('search')):
        $fromDate       = $this->input->post('fromDate');
        $toDate         = $this->input->post('toDate');
        $productid      = $this->input->post('products');
        
        $where = '';
        $date['fromDate']           = $fromDate;
        $this->data['fromDate']     = $fromDate;
        $date['toDate']             = $toDate;
        $this->data['toDate']       = $toDate;
        
        if($productid):
            $where['prod_id']           = $productid;
            $this->data['productid']    = $productid;
        endif;
        
        $this->data['result'] = $this->ReportModel->sale_daily_stock_report($where,$date);
//        echo '<pre>';print_r($this->data['result']);die;
    endif;
    
    
    $this->data['page_title']       = "Daily Sale Report | MTS";
    $this->data['page_header']      = "Daily Sale Report";
    $this->data['page_name']        = "POS/reports/sale_report_v";
    $this->load->view('AppTemplate/common',$this->data);
   }
   public function inventory_stock_status_report(){
      
    $this->data['products']         = $this->CRUDModel->dropDownName('pos_products', 'Select Product', 'pro_id', 'pro_name',array('pro_status'=>1,'user_company_id'=>$this->userInfo->company_id));   
    $this->data['productid']        = '';
    $this->data['fromDate']         = date('d-m-Y');
    $this->data['toDate']           = date('d-m-Y');
     
     
    
    $this->data['result']           = $this->ReportModel->inventory_stock_stauts($this->data);
//     echo '<pre>';print_r($this->data['result']);die;  
    if($this->input->post('search')):
        $fromDate       = $this->input->post('fromDate');
        $toDate         = $this->input->post('toDate');
        $productid      = $this->input->post('products');
        
        $where = '';
        
        $this->data['fromDate']     = $fromDate;
        $this->data['toDate']       = $toDate;
        
        if($productid):
            $where['prod_id']           = $productid;
            $this->data['productid']    = $productid;
        endif;
        
        $this->data['result'] = $this->ReportModel->inventory_stock_stauts($this->data);
//        echo '<pre>';print_r($this->data['result']);die;
    endif;
    
    $this->data['page_title']       = "Inventory Stock Status | MTS";
    $this->data['page_header']      = "Inventory Stock Status";
    $this->data['page_name']        = "POS/reports/daily_stock_status_report_v";
    $this->load->view('AppTemplate/common',$this->data);
   }
      
}
?>