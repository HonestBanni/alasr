<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/PublicController.php');

class SiteController extends PublicController {

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
             $this->load->model('SiteModel');
             $this->load->model('CRUDModel');
             $this->load->library('pagination');
             
            }
     
        public function index(){
            
//            $this->CRUDModel->slugify('Hand Tossed NY Style Pizza');die;
//            echo '<pre>';print_r($this->data);die;
            
            $this->data['page_title']   = 'Home - Al Asr';
            
            $this->data['site_count']   = $this->db->get_where('site_total_count',array('status'=>1))->row();
            $this->data['site_about']   = $this->db->get_where('site_about_us',array('status'=>1))->row();
            $this->data['site_event']   = $this->db->order_by('id','desc')->limit('3','0')->get_where('site_events',array('status'=>1))->result();
            $this->data['site_gallery'] = $this->db->order_by('id','desc')->limit('6','0')->get_where('site_gallery',array('status'=>1))->result();
            $this->data['site_news']    = $this->SiteModel->site_news();
            $this->data['site_banner1'] = $this->SiteModel->site_banner(array('banner_order'=>1,'status'=>1));
            $this->data['site_banner2'] = $this->SiteModel->site_banner(array('banner_order'=>2,'status'=>1));
            $this->data['site_banner3'] = $this->SiteModel->site_banner(array('banner_order'=>3,'status'=>1));
             
//            echo '<pre>';print_r($this->data['site_banner2']);die;
            $this->data['SEO']          = 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically';
            $this->data['page_name']    = 'Site/index_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
        public function event_details(){
            
            $event_slug = $this->uri->segment(2);
            
            $this->data['event_details'] = $this->db->get_where('site_events',array('event_slug'=>$event_slug))->row();
             $this->data['page_title']   = $this->data['event_details']->title;
//             echo "<pre>";print_r($event_details);die;
//            
//            $this->data['site_event']   = $this->db->order_by('id','desc')->get_where('site_events',array('status'=>1))->result();
//            $this->data['site_banner']  = $this->SiteModel->site_banner();
//            echo '<pre>';print_r($this->data['site_banner']);die;
//            $this->data['SEO']          = 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically';
            $this->data['page_name']    = 'Site/event_details_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
        
        
        public function about_us(){

            $this->data['page_title']   = 'About - Al Asr';
            $this->data['SEO']          = 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically';
            $this->data['p_message']    = $this->CRUDModel->get_where_row('site_about_us',array('status'=>1));
            $this->data['our_history']    = $this->CRUDModel->get_where_row('site_our_history',array('status'=>1));
            $this->data['our_history_title1']       = $this->CRUDModel->get_where_result('site_our_history_details',array('status'=>1,'title_type'=>1));
            $this->data['our_history_title2']       = $this->CRUDModel->get_where_result('site_our_history_details',array('status'=>1,'title_type'=>2));
            $this->data['page_name']    = 'Site/about_us_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
    public function events(){
             
            $config['base_url']         = base_url('Events');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('site_events',array('status'=>1)));  
            $config['per_page']         = 10;
            $config["num_links"]        = 2;
            $config['uri_segment']      = 3;
            $config['full_tag_open']    = "<ul class='clearfix'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
            $config['last_link']        = "<i class='fa fa-angle-right'></i>";


            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pages']        = $this->pagination->create_links();
            $custom['column']    ='id';
            $custom['order']     ='desc';          
            $this->data['site_event']    = $this->CRUDModel->pagination('site_events',$config['per_page'], $page,array('status'=>1),$custom);
            $this->data['page_title']   = 'Events - Al Asr';
            $this->data['SEO']          = 'Dont Miss Our Events al asr events ';
//            $this->data['site_event']    = $this->CRUDModel->get_where_result('site_events',array('status'=>1));
            
            $this->data['page_name']    = 'Site/events_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
        public function gallery(){
             $config['base_url']         = base_url('Gallery');
            $config['total_rows']       = count($this->CRUDModel->get_where_result('site_gallery',array('status'=>1)));  
            $config['per_page']         = 10;
            $config["num_links"]        = 2;
            $config['uri_segment']      = 3;
            $config['full_tag_open']    = "<ul class='clearfix'>";
            $config['full_tag_close']   = "</ul>";
            $config['num_tag_open']     = '<li>';
            $config['num_tag_close']    = '</li>';
            $config['cur_tag_open']     = "<li class='disabled'><li class='active'><a href='javascript:vodid(0)'>";
            $config['cur_tag_close']    = "</a></li>";
            $config['next_tag_open']    = "<li>";
            $config['next_tag_close']   = "</li>";
            $config['prev_tag_open']    = "<li>";
            $config['prev_tag_close']   = "</li>";
            $config['first_tag_open']   = "<li>";
            $config['first_tag_close']  = "</li>";
            $config['last_tag_open']    = "<li>";
            $config['last_tag_close']   = "</li>";
            $config['first_link']       = "<i class='fa fa-angle-left'></i>";
            $config['last_link']        = "<i class='fa fa-angle-right'></i>";


            $this->pagination->initialize($config);
            $page                       = is_numeric($this->uri->segment(2)) ? $this->uri->segment(2) :  0;
            $this->data['pages']        = $this->pagination->create_links();
            $custom['column']    ='id';
            $custom['order']     ='desc';          
            $this->data['site_gallery']    = $this->CRUDModel->pagination('site_gallery',$config['per_page'], $page,array('status'=>1),$custom);
            
            $this->data['page_title']   = 'Gallery - Al Asr';
            $this->data['SEO']          = 'Al Asr Education systems gallery pictures ';
//            $this->data['site_gallery']    = $this->CRUDModel->get_where_result('site_gallery',array('status'=>1));
            
            $this->data['page_name']    = 'Site/gallery_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
        public function contact_us(){
             
            
            
            if($this->input->post()):
           
                $name = $this->input->post('username');
                $email = $this->input->post('email');
                $phone = $this->input->post('phone');
                $subject = $this->input->post('subject');
                $message = $this->input->post('message');
                
                $data = array(
                 'name'   =>$name,
                 'email'   =>$email,
                 'phone_nu'   =>$phone,
                 'subject'   =>$subject,
                 'message'   =>$message,
                );
                
                
                $this->load->library('email');

                $this->email->from('info@alasr.edu.pk', 'Al Asr Education Systems');
                $this->email->to($email);
                $this->email->cc('info@alasr.edu.pk');
                $this->email->bcc('bilal.online1@gmail.com');
//                $this->email->bcc('them@their-example.com');

                $this->email->subject($subject);
                $this->email->message($message);

                if($this->email->send()):
                   $this->CRUDModel->insert('site_contact_email',$data);  
                endif;
            endif;
            
            $this->data['page_title']   = 'Contact - Al Asr';
            $this->data['SEO']          = 'Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically';
            $this->data['page_name']    = 'Site/contact_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
        public function error_page(){

            $this->data['page_title']   = '404 - Al Asr';
            $this->data['SEO']          = '404 error';
            $this->data['page_name']    = 'Site/error_v';
            $this->load->view('SiteTemplate/common',$this->data);    
        }
}
  
