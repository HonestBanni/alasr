<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/PublicController.php');

class LoginController extends PublicController {

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

    
          public function __construct() {
             parent::__construct();
             ob_start();
            }
     
        public function index(){
            
            $result                     = $this->db->get_where('app_register_companies',array('status'=>1,'account_type'=>1))->row();
            $this->data['page_header']  = $result->title;
            $this->data['page_title']   = $result->title;
            $this->data['ico']          = $result->ico;
            $this->data['SEO']          = 'Mino Tech Systems is a company based in Peshawar KPK, Pakistan, which provides IT solutions including graphics and web design, web development and web hosting';
            $this->load->view('AppTemplate/headerlogin',$this->data);    
            $this->load->view('Login/login_v',$this->data);
            
        }
 
    public function login_authentication(){
             
        
            if($this->input->post()):
               
                $userEmail      = $this->input->post('useremail');
                $userPassword   = $this->input->post('password');
                $loginCode      = $this->input->post('loginCode');
                
                $userinputs = array(
                    'email'     => $userEmail,
                    'password'  => $userPassword
                        );
                 //Clear by XSS security 
                $data = $this->security->xss_clean($userinputs);
              
                if($data):
                     $where = array(
                        'email'         => $userEmail,
                        'password'      => md5($userPassword),
                        'user_status'   => 1,
                        'status'        => 1
                    );
                 
                                  $this->db->select('
                                          app_users.*,
                                          app_register_companies.title,
                                          app_register_companies.logo,
                                          app_register_companies.ico,
                                          app_register_companies.account_type,
                                          app_register_companies.print_logo,
                                          ');  
                                  $this->db->join('app_register_companies','app_register_companies.id=app_users.company_id');  
                    $result_set = $this->db->get_where('app_users',$where)->row();
                    
                    if(!empty($result_set)):
                        
                        $userData['login_user_info'] = array(    
                                'user_id'           => $result_set->id,
                                'email'             => $result_set->email,
                                'lgoinCode'         => $loginCode,
                                'emp_id'            => $result_set->user_empId,
                                'company_id'        => $result_set->company_id,
                                'title'             => $result_set->title,
                                'logo'              => $result_set->logo,
                                'ico'               => $result_set->ico,
                                'print_logo'        => $result_set->print_logo,
                                'default_page'      => $result_set->default_page,
                                'user_roleId'       => $result_set->user_roleId,
                                'loginStatus'       => TRUE,
                                'is_logged_in'      => 1
                            );
                        $this->session->set_userdata($userData);
                         
                        redirect('Dashboard');
                        else:
                        $this->session->set_flashdata('login_error', 'User Inputs are not valid <br/> Please Try again or <br/><a href="mailto:info@minotech.systems">info@minotech.systems</a>');
                        redirect('Login');
                    endif;
                    
                    else:
                       $this->session->set_flashdata('login_error', 'User Inputs are not valid <br/> Please Try again or <br/><a href="mailto:info@minotech.systems">info@minotech.systems</a>');
                        redirect('Login');
                endif;
               
            endif;
  }
      
    public function logout(){
            
            $session = $this->session->all_userdata();
             
            if(!empty($session)):
                $this->session->unset_userdata('login_user_info');
                $this->session->sess_destroy();
                redirect('Login');
            else:
                redirect('Home');
            endif;
        }
}
