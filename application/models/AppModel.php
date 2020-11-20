<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class AppModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }

    public function UPL1($where){
        
        $query = $this->db->select('*')
                ->from('user_policyl1')
                ->where($where)
                 ->order_by('m1_order','asc')
                 ->order_by('m1_name','asc')
                 ->join('menul1','menul1.m1_id=user_policyl1.upl1_m1Id')
                ->get();
        return $query->result();
    }
    public function UPL2($where){
        
        $query = $this->db->select('*')
                ->from('user_policyl2')
                ->where($where)
                ->order_by('m2_order','asc')
                 ->join('menul2','menul2.m2_id=user_policyl2.up2_m2Id')
                ->get();
        return $query->result();
    }
    public function UPL3($where){
        
        $query = $this->db->select('*')
                ->from('user_policyl3')
                ->where($where)
                ->join('menul3','menul3.m3_id=user_policyl3.upl3_m3Id')
                ->get();
        return $query->result();
    }
    public function get_menulevel_2(){
        
        return  $this->db->join('menul1','menul1.m1_id=menul2.m2_m1Id')->order_by('m2_id','desc')
                ->get_where('menul2',array('m1_status'=>1))->result();
    }
    public function get_menulevel_3(){
        
        return  $this->db
                 ->join('menul2','menul2.m2_id=menul3.m3_m2Id','left outer')
                 ->join('menul1','menul1.m1_id=menul3.m3_m1Id','left outer')
 
                ->order_by('m3_id','desc')
                ->get('menul3')->result();
    }
	
    public function user_by_group(){
         $query = $this->db->select('
                app_users.id,
                app_users.email,
                app_users.password,
                app_users.user_status,
                app_users.user_date,
                users_role.ur_name,
                hr_emp_record.emp_name
        ')
                ->from('app_users')
                ->join('users_role','users_role.ur_id=app_users.user_roleId','left outer')
                ->join('hr_emp_record','hr_emp_record.emp_id=app_users.user_empId')
                ->get();
        return $query->result();
    }
    public function user_by_group_where($where){
        $query = $this->db->select('*')
                ->from('app_users')
                ->where($where)
                ->join('users_role','users_role.ur_id=app_users.user_roleId','left outer')
                ->get();
        return $query->row();
    } 
    public function menu1_results(){
               $this->db->join('common_status','common_status.id=menul1.m1_status'); 
               $this->db->order_by('m1_status','desc');
               $this->db->order_by('m1_order','asc');
        return $this->db->get('menul1')->result();
    }
    
    
}
