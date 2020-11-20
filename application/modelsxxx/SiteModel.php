<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class SiteModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }
    
    public function site_banner($where){
        
                $this->db->order_by('banner_order');
       return   $this->db->get_where('site_banner',$where)->row();
     }
    public function site_news(){
             $this->db->join('app_users','app_users.id=site_news.user_id');
             $this->db->join('hr_emp_record','hr_emp_record.emp_id=app_users.user_empId');
      return $this->db->limit('3','0')->order_by('site_news.id','desc')->get_where('site_news',array('site_news.status'=>1))->result();
     }
   
     
   //Admin Panel Function 
     
    public function admin_site_nav(){
                $this->db->select('
                        site_nav.id as site_id,
                        site_nav.title as site_title,
                        site_nav.function_name,
                        site_nav.nav_order,
                        site_status.title as status_title,
                        ');
                $this->db->join('site_status','site_status.id=site_nav.status');
                $this->db->order_by('nav_order');
       return   $this->db->get_where('site_nav')->result();
     }
      public function home_banner_show($where=NULL){
                $this->db->select('
                        site_banner.*,
                        site_status.title as status_title,
                        ');
                $this->db->join('site_status','site_status.id=site_banner.status');
                $this->db->order_by('banner_order');
                if($where):
                    $this->db->where($where);
                endif;
       return   $this->db->get_where('site_banner')->result();
     }
      public function gallery_picture_show($where=NULL){
               
                  $this->db->select('
                        site_gallery.*,
                        site_status.title as status_title,
                        ');
                $this->db->order_by('id','desc');
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->join('site_status','site_status.id=site_gallery.status');
       return   $this->db->get_where('site_gallery')->result();
     }
      public function admin_news_show($where=NULL){
               
                   
                $this->db->order_by('id','desc');
                if($where):
                    $this->db->where($where);
                endif;
               
       return   $this->db->get_where('site_news')->result();
     }
      public function admin_site_nav_search($like){
                $this->db->select('
                        site_nav.id as site_id,
                        site_nav.title as site_title,
                        site_nav.function_name,
                        site_nav.nav_order,
                        site_status.title as status_title,
                        ');
                $this->db->join('site_status','site_status.id=site_nav.status');
                $this->db->like('site_nav.title',$like);
                $this->db->or_like('site_nav.title',$like);
                $this->db->order_by('nav_order');
       return   $this->db->get_where('site_nav')->result();
     }
 
    
}
