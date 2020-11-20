<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PublicController extends MY_Controller {

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
            date_default_timezone_set('Asia/Karachi');
            ob_start(); 
            $this->data['app_setting']   =  $this->app_setting();
            $this->data['site_nav']      =  $this->site_nav();
             
            
        }
    
        public function app_setting(){
             
            return  $this->db->get_where('app_setting',array('status'=>1))->row();
        }
        public function site_nav(){
            
           return $this->db->get_where('site_nav',array('status'=>1))->result();
        }
       
}

