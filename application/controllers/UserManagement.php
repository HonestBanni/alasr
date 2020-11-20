<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');

class UserManagement extends AdminController {
//   
    public $userinfo = '';
    public function __construct() {
        parent::__construct();
//        $this->load->model('CRUDModel');
//        $this->load->model('AppModel');
//        $this->load->library("pagination");   
        $this->userInfo = json_decode(json_encode($this->getUser()), FALSE);
        ob_start();
    }
    
    public function index(){
            
            $this->data['Showmessage']      =  $this->db->get_where('message',array('status'=>'1'))->result();
            $this->data['page_name']        =  "AppTemplate/Dashboard";
            $this->data['page_title']       =  'Home | MTS';
            $this->data['SEO']              =  'Mino Tech Systems is a company based in Peshawar KPK, Pakistan, which provides IT solutions including graphics and web design, web development and web hosting';
            $this->data['page_header']      =  'Home';
            $this->load->view('AppTemplate/common',$this->data);
        }
    
    
    
    public function userRole(){

        $this->data['userRoleResult']         = $this->CRUDModel->getResults('users_role');

        $uri                            = $this->uri->segment(2);
        if($uri):
            $where                      = array('ur_id'=>$uri);
            $userRole     = $this->CRUDModel->get_where_row('users_role',$where);
            
            $this->data['groupName']        = $userRole->ur_name;    
            $this->data['user_role_id']     = $userRole->ur_id;
            
            $this->data['page_name']    = "UserManagement/user_role";
            $this->data['page_title']   = 'User Edit Pages| MTS';
            $this->load->view('AppTemplate/common',$this->data);
            else:
            $this->data['groupName']        = '';    
            $this->data['user_role_id']     = '';    
             $this->data['page_name']         = "UserManagement/user_role";
            $this->data['page_title']        = 'User Edit Pages| MTS';
            $this->load->view('AppTemplate/common',$this->data);
        endif;


    }
    public function userRoleCreate(){
            $groupName          =  $this->input->post('groupName');
            $ur_id              =  $this->input->post('ur_id');
            $userInfo           =  $this->getUser();
            $data               =  array(
            'ur_name'           => $groupName,
            'ur_userId'         => $userInfo['user_id'],
            );

            if($ur_id):
                 $where         = array('ur_id'=>$ur_id);
                $this->CRUDModel->update('users_role',$data,$where);
                else:
                $this->CRUDModel->insert('users_role',$data);
            endif;
            redirect('userRole'); 
    }
    public function dbUser(){
            $dbUserId = $this->uri->segment(2);
            
            if($dbUserId):
                $wherePrg                     = array('ur_status'=>'1');
                $this->data['dbUserInfo']     = $this->AppModel->user_by_group_where(array('id'=>$dbUserId));
               // echo '<pre>';print_r($this->data['dbUserInfo']);
                $this->data['dbUser']         = $this->AppModel->user_by_group('users');
                
                else:
                   $this->data['dbUser']         = $this->AppModel->user_by_group();
                endif;
            
            
            $wherePrg                   = array('ur_status'=>'1');
            $this->data['userGorup']    = $this->CRUDModel->dropDown('users_role', 'Select Group', 'ur_id', 'ur_name',$wherePrg);    
            $this->data['emp']          = $this->CRUDModel->dropDown('hr_emp_record', 'Select EMployee', 'emp_id', 'emp_name'); 
            $this->data['page_name']         = "UserManagement/db_user";
            $this->data['page_title']        = 'User Edit Pages| MTS';
            $this->load->view('AppTemplate/common',$this->data);   
        }
    public function dbUserCreate(){
             
                if($this->input->post()):
                    $userName   = $this->input->post('userName');
                    $userGroup  = $this->input->post('userGroup');
                    $ur_status  = $this->input->post('ur_status');
                    $userPwd    = $this->input->post('userPwd');
                    $emp_id    = $this->input->post('emp');
                    
                    $user_id     = $this->input->post('user_id');
                    if($user_id):
                        $wherePwd = array('id'=>$user_id,'password' =>$userPwd);
                        $PwdCheck = $this->CRUDModel->get_where_row('users',$wherePwd);
                            if($PwdCheck):
                                $data = array(
                                    'email'         =>$userName,
                                    'user_roleId'   =>$userGroup,
                                    'user_status'   =>$ur_status,
                                    'password'      =>$userPwd,
                                    'user_empId'      =>$emp_id,
                                    );
                                $where = array( 'id'=>$user_id);
                                $this->CRUDModel->update('users',$data,$where);
                                redirect('dbUser');
                            else:
                                $data = array(
                                    'email'         =>$userName,
                                    'user_roleId'   =>$userGroup,
                                    'user_status'   =>$ur_status,
                                    'password'      =>md5($userPwd),
                                    'user_empId'      =>$emp_id,
                                    );
                                $where = array( 'id'=>$user_id);
                                $this->CRUDModel->update('users',$data,$where);
                                redirect('dbUser');
                        endif;
                         
                    else:
                        $data = array(
                            'email'         =>$userName,
                            'user_roleId'   =>$userGroup,
                            'password'      =>md5($userPwd),
                            'user_empId'      =>$emp_id,
                            
                        );
                        
                        $this->CRUDModel->insert('users',$data);
                        redirect('dbUser');
                    endif;    
                
                else:
                    $this->data['dbUser']         = $this->CRUDModel->getResults('users');
                    $this->data['page']         = "userPolicy/db_user";
                    $this->data['title']        = 'User Edit Pages| MTS';
                    $this->load->view('AppTemplate/common',$this->data);  
                endif;
          }
    public function groupPolicy(){
           
 
            $groupId = $this->uri->segment(2);
            
            $this->data['UrRecord']     = $this->CRUDModel->get_where_result('user_policyl2',array('upl2_urId'=>$groupId));
            $where                      = array('ur_id'=>$groupId);
            $this->data['layer2']     = $this->CRUDModel->get_where_row('users_role',$where);
//            echo '<pre>';print_r($this->data['UrRecord']);die;
            $this->data['menu1']    =   $this->CRUDModel->get_where_result('menul1',array('m1_status'=>1));    
            $this->data['page_name']     =   "UserManagement/group_policy";
            $this->data['page_title']    =   'Group Policy Layer 2| MTS';
            $this->load->view('AppTemplate/common',$this->data);   
        }
    public function group_policy_Lthree(){
      
  
        $groupId = $this->uri->segment(2);
 
        $whereUR = array(
            'upl2_urId'=>$groupId
        );
        $this->data['UrRecord']     = $this->CRUDModel->get_where_result('user_policyl2',$whereUR);
         $where                      = array('ur_id'=>$groupId);
        $this->data['layer2']       = $this->CRUDModel->get_where_row('users_role',$where);
        $this->data['menu1']        = $this->CRUDModel->get_where_result('menul1',array('m1_status'=>1));    
        $this->data['page']         = "userPolicy/group_policy_Lthree";
        $this->data['title']        = 'Group Policy Layer 3| MTS';
        $this->load->view('AppTemplate/common',$this->data);   
    }    
    public function policySave(){
            
            $checBox = $this->input->post('checkBox');
            $userId  = $this->input->post('urIds');
            $userInfo = $this->getUser();
            
            //Delete Old Menu1...
            
            $this->CRUDModel->deleteid('user_policyl2',array('upl2_urId'=>$userId));
            //Delete Old Menu2...
            $this->CRUDModel->deleteid('user_policyl1',array('upl1_urId'=>$userId));
            
            foreach($checBox as $key=>$value):
                $val = explode(',',$value);
                
                $m1 = $val[0];
                $m2 = $val[1];
                //level 1 menu insertion
                $dataL1 = array('upl1_m1Id'=>$m1,'upl1_urId'=>$userId,'upl1_usrId'=>$userInfo['user_id']);
               $CheckList = $this->CRUDModel->get_where_row('user_policyl1',$dataL1);
               if($CheckList):
                    else:
                   $this->CRUDModel->insert('user_policyl1',$dataL1);
               endif;
               
                //level 2 menu insertion
                $dataL2 = array('up2_m1Id'=>$m1,'up2_m2Id'=>$m2,'upl2_urId'=>$userId,'up2_usrId'=>$userInfo['user_id']);
                $this->CRUDModel->insert('user_policyl2',$dataL2);
                
                
            endforeach;
          redirect('userRole');
        }
    public function policy_third_layer(){
            
            $checBox = $this->input->post('checkBox');
            $userId  = $this->input->post('urIds');
            $userInfo = $this->getUser();
//            echo '<pre>';print_r($checBox);die;
            //Delete Old Menu1...
            
            $this->CRUDModel->deleteid('user_policyl3',array('upl3_urId'=>$userId));
            //Delete Old Menu2...
//            $this->CRUDModel->deleteid('user_policyl1',array('upl1_urId'=>$userId));
            
            foreach($checBox as $key=>$value):
                $val = explode(',',$value);
                
                $m1 = $val[0];
                $m2 = $val[1];
                $m3 = $val[2];
    
                $dataL3 = array(
                    'upl3_urId'=>$userId,
                    'upl3_m1Id'=>$m1,
                    'upl3_m2Id'=>$m2,
                    'upl3_m3Id'=>$m3,
                    'up3_usrId'=>$userInfo['user_id']
                        );
                
                $this->CRUDModel->insert('user_policyl3',$dataL3);
                
                
            endforeach;
          redirect('userRole');
        }
    public function menu_Level1(){
       
        $this->data['menuName']     = '';
        $this->data['level_Id']     = '';
        $this->data['menuorder']    = '';
        $this->data['status_Id']    = '';
        $this->data['btn']          = 'Add Menu';
        $this->data['status']       = $this->CRUDModel->dropDown('common_status', 'Select Status', 'id', 'title',array('status'=>1));;
        
        if($this->input->post()):

           $menuName        = $this->input->post('menuName');
           $level1Id        = $this->input->post('level_id');
           $menuorder        = $this->input->post('menuorder');
           $status        = $this->input->post('status');
           
           if($level1Id):
               $where = array('m1_id'=>$level1Id);
               $data = array(
                   'm1_name'        =>$menuName,
                   'm1_order'        =>$menuorder,
                   'm1_status'        =>$status,
                   'm1_date_up'    =>date('Y-m-d H:i:s'),
                   'm1_userId_up'  => $this->userInfo->user_id
                       );
               $this->update('menul1',$data,$where);
               redirect('HeaderNav');
               else:
               $data = array(
                   'm1_name'    =>$menuName,
                   'm1_order'        =>$menuorder,
                   'm1_status'        =>$status,
                   'm1_date'    =>date('Y-m-d H:i:s'),
                   'm1_userId'  => $this->userInfo->user_id
                       );
               $this->CRUDModel->insert('menul1',$data);
               redirect('HeaderNav');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $level1Menu = $this->CRUDModel->get_where_row('menul1',array('m1_id'=>$uri2));
            
            $this->data['menuName']     = $level1Menu->m1_name;
            $this->data['level_Id']     = $level1Menu->m1_id;
            $this->data['menuorder']    = $level1Menu->m1_order;
            $this->data['status_Id']    = $level1Menu->m1_status;
            $this->data['btn']          = 'Update Menu';
        
        
        
        endif;
        $this->data['menuLeve1']    = $this->AppModel->menu1_results();
        $this->data['page_name']         = "UserManagement/level1";
        $this->data['page_title']        = 'User Edit Pages| MTS';
        $this->load->view('AppTemplate/common',$this->data); 
    }
    public function delete_menu_Level1(){
            $uri2 = $this->uri->segment(2);
            $where = array('m1_id'=>$uri2);
            $this->deleteid('menul1',$where);
            redirect('HeaderNav');
        }
    public function menu_Level2(){

        $this->data['menu1']    = $this->dropDown('menul1', 'Select Menu 1', 'm1_id', 'm1_name',array('m1_status'=>1));    
        $this->data['menu1_id'] = '';
        $this->data['menuName'] = '';
        $this->data['level_Id'] = '';
        $this->data['order']    = '';
        $this->data['flag']    = '';
        $this->data['function'] = '';
        $this->data['btn']      = 'Add Menu';
        $userInfo = $this->getUser();
        if($this->input->post()):

           $name        = $this->input->post('userName');
           $level1Id    = $this->input->post('level_id');
           $function    = $this->input->post('function');
           $menu1_id    = $this->input->post('menu1_id');
           $order       = $this->input->post('order');
           $flag        = $this->input->post('flag');
           
           
           if($level1Id):
               
               $where = array('m2_id'=>$level1Id);
               $data = array(
                   'm2_name'        =>$name,
                   'm2_function'    =>$function,
                   'm2_order'       =>$order,
                   'm2_m1Id'        =>$menu1_id,
                   'm2_flag'        =>$flag,
                   'm2_date'        =>date('Y-m-d H:i:s'),
                   'm2_usrId'       => $userInfo['user_id']
                       );
               $this->update('menul2',$data,$where);
               redirect('menuLevel2');
               else:
               $data = array(
                   'm2_name'        =>$name,
                   'm2_function'    =>$function,
                   'm2_m1Id'        =>$menu1_id,
                    'm2_flag'        =>$flag,
                   'm2_order'       =>$order,
                   'm2_date'        =>date('Y-m-d H:i:s'),
                   'm2_usrId'      => $userInfo['user_id']
                       );
               $this->insert('menul2',$data);
               redirect('menuLevel2');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $level1Menu2    = $this->CRUDModel->get_where_row('menul2',array('m2_id'=>$uri2));
            $this->data['menu1_id']     = $level1Menu2->m2_m1Id;
            $this->data['function']     = $level1Menu2->m2_function;
            $this->data['menuName']     = $level1Menu2->m2_name;
            $this->data['order']        = $level1Menu2->m2_order;
            $this->data['flag']         = $level1Menu2->m2_flag;
            $this->data['level_Id']     = $level1Menu2->m2_id;
            $this->data['btn']          = 'Update Menu';
        endif;
        $this->data['menuLeve12']    = $this->AppModel->get_menulevel_2();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page_name']         = "UserManagement/level2";
        $this->data['page_title']        = 'Menu Level 2| MTS';
        $this->load->view('AppTemplate/common',$this->data); 

    }
    public function delete_menu_Level2(){
            $uri2 = $this->uri->segment(2);
            $where = array('m2_id'=>$uri2);
            $this->CRUDModel->deleteid('menul2',$where);
            redirect('menuLevel2');
        }
    public function menu_Level3(){

        $this->data['menu1']        = $this->CRUDModel->dropDown('menul1', 'Select Menu 1', 'm1_id', 'm1_name');    
        $this->data['menu2']        = $this->CRUDModel->dropDown('menul2', 'Select Menu 2', 'm2_id', 'm2_name');    
        $this->data['menu1_id']     = '';
        $this->data['menu2_id']     = '';
        $this->data['menuName']     = '';
        $this->data['level2_Id']    = '';
        $this->data['function']     = '';
        $this->data['btn']          = 'Add Menu';
        $userInfo = $this->getUser();
        if($this->input->post()):

            $name        = $this->input->post('name');
            $function    = $this->input->post('function');
            $menu1_id    = $this->input->post('menu1_id');
            $menu12_id   = $this->input->post('menu12_id');
            $level1Id    = $this->input->post('level2_id');
        if($level1Id):
               
           $where = array('m3_id'=>$level1Id);
           $data = array(
                'm3_name'        =>$name,
                'm3_function'    =>$function,
                'm3_m1Id'        =>$menu1_id,
                'm3_m2Id'        =>$menu12_id,
                'm3_date'        =>date('Y-m-d H:i:s'),
                'm3_usrId'       => $userInfo['user_id']
            );
            $this->CRUDModel->update('menul3',$data,$where);
               redirect('menuLevel3');
               else:
               $data = array(
                   'm3_name'        =>$name,
                   'm3_function'    =>$function,
                   'm3_m1Id'        =>$menu1_id,
                   'm3_m2Id'        =>$menu12_id,
                   'm3_date'        =>date('Y-m-d H:i:s'),
                   'm3_usrId'       => $userInfo['user_id']
                       );
               $this->CRUDModel->insert('menul3',$data);
               redirect('menuLevel3');
           endif;

        endif;

        $uri2 = $this->uri->segment(2);
        if($uri2):
            $level1Menu2                = $this->CRUDModel->get_where_row('menul3',array('m3_id'=>$uri2));
            $this->data['menu1_id']     = $level1Menu2->m3_m1Id;
            $this->data['menu2_id']     = $level1Menu2->m3_m2Id;
            $this->data['menuName']     = $level1Menu2->m3_name;
            $this->data['level2_Id']    = $level1Menu2->m3_id;
            $this->data['function']     = $level1Menu2->m3_function;
            $this->data['btn']          = 'Update Menu';
        endif;
        $this->data['menuLeve12']    = $this->AppModel->get_menulevel_3();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page_name']         = "UserManagement/level3";
        $this->data['page_title']        = 'Menu Level 3| MTS';
        $this->load->view('AppTemplate/common',$this->data); 

    }
    public function menu2_section(){
        $menu2ID = $this->input->post('menu1_id');
        
        $result  = $this->CRUDModel->get_where_result('menul2',array('m2_m1Id'=>$menu2ID));
        foreach($result as $row):
            echo '<option value='.$row->m2_id.'>'.$row->m2_name.'</option>';
        endforeach;
        
    }
    public function delete_menu_Level3(){
            $uri2 = $this->uri->segment(2);
            $where = array('m3_id'=>$uri2);
            $this->CRUDModel->deleteid('menul3',$where);
            redirect('menuLevel3');
        }
     public function user_restricted_page(){
        $this->data['menuLeve12']    = $this->AppModel->get_menulevel_3();
//        echo '<pre>';print_r($this->data['menuLeve12']);die;
        $this->data['page_name']         = "Login/user_restricted_v";
        $this->data['page_title']        = 'Restricted Page| MTS';
        $this->load->view('AppTemplate/common',$this->data); 

    }    
       
}
