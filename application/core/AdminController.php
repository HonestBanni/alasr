<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminController extends MY_Controller {

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
	 * map to /index.php/welcomee/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
    
        public function __construct() {
             parent::__construct();
            ob_start();
            date_default_timezone_set('Asia/Karachi');
             $session                       = $this->session->all_userdata();
            if(empty($session['login_user_info'])):  redirect('Login');  endif;
                
            $this->data['userInfo']         =   json_decode(json_encode($this->getUser()), FALSE);
            $this->data['app_setting']      =   $this->app_setting();
            $this->data['userRole']         =   $this->user_role();
            $this->data['employee_info']    =   $this->get_employee_info();
            $this->userInfo                 =   json_decode(json_encode($this->getUser()), FALSE);
            $this->url_security();
            $this->load->model('CRUDModel');
            
        }
        
        public function user_role(){
                    $session        = $this->session->all_userdata();
                        
                    return  $this->db->get_where('users_role',array('ur_id'=>$session['login_user_info']['user_roleId']))->row();
            }
        public function getUser(){
                    $session        = $this->session->all_userdata();
                    return $session['login_user_info'];
            }
            
        public function app_setting(){
             
            return json_decode(json_encode($this->getUser()), FALSE);

        }
       
        public function url_security(){
               $segs    = $this->uri->segment_array();
               $url     = '';
               $sn      = '';
               $count_url = count($segs);
               foreach ($segs as $element) {
                   $sn ++;
                   if($count_url == $sn):
                        if(is_numeric($element)):
                           $url .= ':num';
                        else:
                            $url .= $element;
                       endif;
                    else:
                       if(is_numeric($element)):
                            $url .= ':num/';   
                        else:
                           $url .= $element.'/';
                       endif;
                    endif;
                    
                }
               
                if($url === 'admin/admin_home' || $url === 'Admin/admin_home'):
                    
               else:
                
                
                //URL Insert Section
                $user_menu      = '';
                $message        = '';
//                $check          = $this->db->get_where('menu_extra_url',array('url'=>$url));
                $url_2_info     =  $this->db->get_where('menul2',array('m2_function'=>$url))->row();
                $url_3_info     =  $this->db->get_where('menul3',array('m3_function'=>$url))->row(); 
                                
                if($url_2_info):
                     
                    //  echo '<pre>';print_r($url_2_info);
                        $m2_id     = $url_2_info->m2_id;
                            $where = array(
                                'upl2_urId'    => $this->userInfo->user_roleId,  
                                'up2_m2Id'     => $m2_id 
                           );
                           
                        $url_menu_2 =   $this->db->get_where('user_policyl2',$where);
                        if($url_menu_2->num_rows()>0):
                           
                           $message     = 'User register in this menu';
                        else:
                           
                           $message     = 'User NOT register in this menu'; 
//                            redirect('restricted');
                        endif;
                endif;
                
                if($url_3_info):
                    $m3_id     = $url_3_info->m3_id;
                        $where = array(
                            'upl3_urId'    => $this->userInfo->user_roleId,  
                            'upl3_m3Id'     => $m3_id 
                       );
                           
                        $url_menu_3 =   $this->db->get_where('user_policyl3',$where);
                        if($url_menu_3->num_rows()>0):
                            $message     = 'User register in this menu';
                        else:
                            echo $message     = 'User NOT register in this menu';
                            redirect('restricted');
                        endif;
                endif; 
                endif; 
               
             
       }       
  
        public function get_employee_info(){
        
                $this->db->SELECT('
                    app_users.*,
                    hr_emp_record.*,
                        hr_emp_designation.title as designation,
                        department.title as department, '); 
 
                $this->db->join('hr_emp_record','hr_emp_record.emp_id=app_users.user_empId', 'left outer');
                $this->db->join('hr_emp_designation','hr_emp_designation.emp_desg_id=hr_emp_record.current_designation', 'left outer');
//              $this->db->join('hr_emp_scale','hr_emp_scale.emp_scale_id=hr_emp_record.c_emp_scale_id', 'left outer');
//              $this->db->join('hr_emp_contract_type','hr_emp_contract_type.contract_type_id=hr_emp_record.contract_type_id', 'left outer');
                $this->db->join('department','department.department_id=hr_emp_record.department_id', 'left outer'); 
      return    $this->db->get_where('app_users',array('id'=>$this->data['userInfo']->user_id))->row();
    }
    
     
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Common Functions------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    
    
    
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Update By ID------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function update($table,$data,$where)
    {
        $this->db->where($where);
        $this->db->update($table,$data);
    }
    
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Insert Records------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function insert($table,$field){
        if($this->db->insert($table,$field)){
            $id = $this->db->insert_id();
            return $id;
            
        }else{
            return false;
        }
    }
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Delete By ID------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function deleteid($table,$where)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }
    
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Navigation menus------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    
   
    
    
    public function dropDown($table, $option=NULL, $value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                 $this->db->order_by($show,'asc');
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show;
			}
			return $data;
		}
	}
}

