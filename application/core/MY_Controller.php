<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller {
 
    
        public function __construct() {
             parent::__construct();
            $this->data['company_info']     =   $this->get_company_info();
            $this->data['active_uri']       =   $this->uri->segment(1);
            }
            
        /*  Load the layout and set the ouput
        */
      
         public function get_company_info(){
             
                     $this->db->select(
                             '
                                 title as page_header, 
                                 title as page_title, 
                                 logo, 
                                 logo2, 
                                 ico, 
                             '
                             );
            $query = $this->db->get_where('app_register_companies',array('status'=>1,'account_type'=>1))->row();
            return json_decode(json_encode($query), FALSE);

        }    
            
            
}

