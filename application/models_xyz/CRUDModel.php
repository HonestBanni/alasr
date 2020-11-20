<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


class CRUDModel extends CI_Model{

    public function __construct()
    {
        parent::__construct();
         $this->db->query('SET SQL_BIG_SELECTS=1');
    }

    //Get all record By ID 
    public function getResults($table){
        $query = $this->db->select('*')
                ->FROM($table)
                ->get();
        return $query->result();
    }
    //get results requ: tableName,where
    public function get_where_result($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where($where)
                         ->get();
            return $query->result();
   }
    //get results requ: tableName,where
    public function get_where_result_limit_order($table,$custom){
        $query =$this->db->SELECT('*')
                        ->FROM($table)
                        ->limit($custom['limit'],$custom['start'])
                        ->order_by($custom['column'],$custom['order'])
                        //->where($where)
                        ->get();
            return $query->result();
   }
 
    //get results requ: tableName,where
    public function get_where_result_order($table,$where=NULL,$custom){
            $this->db->SELECT('*'); 
            $this->db->FROM($table);
            $this->db->order_by($custom['column'],$custom['order']);
            if($where):
                $this->db->where($where);
            endif;
            
            $query =$this->db->get();
            return $query->result();
   }
    //get results requ: tableName,where
    public function get_where_row($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where($where)
                         ->get();
            return $query->row();
   }
   public function count_all($table){
        return $this->db->count_all($table);
   } 
  public function pagination($table,$SPP,$page,$where=NULL,$order=NULL){
       
           
                $this->db->limit($SPP,$page);
                if($order):
                $this->db->order_by($order['column'],$order['order']);    
                endif;
                if($where):
                    $this->db->where($where);
                endif;
           return  $this->db->get($table)->result();
          
   }
   
    
     //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Trashe By ID------------------------------------------------------------>
    //---------------------------------------------------------------------------------------------------------->
    public function Trashe($where,$data)
    {
        $this->db->where($where);
        $this->db->update('scheme',$data);
    }
  
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------Dynamic Drop Down Function --------------------------------------------------->
    //---------------------------------------------------------------------------------------------------------->

 

    function dropDownName($table, $option=NULL,$value,$show,$where=NULL){
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
    
        
    function sub_proDropDown($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
                    $this->db->join('programes_info','programes_info.programe_id=sub_programes.programe_id');
                    $this->db->order_by($show,'asc');
                
                
                $query = $this->db->get($table);
		
		if($query->num_rows() > 0) 
		{
                    if($option):
                        $data[''] = $option;
                    endif;
			
			foreach($query->result() as $row) 
			{
				$data[$row->$value] = $row->$show.' ('.$row->programe_name.')';
			}
			return $data;
		}
	} 
    
    
  
        function dropDown_where_in($table, $option=NULL, $value,$show,$column=NULL,$array=NULL)
	{
		$this->db->select('*');
               // $this->db->distinct();
                
                    $this->db->where_in($column,$array);
                 
                 
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
        function dropDownKey($table, $option=NULL,$value,$show,$where=NULL){
		$this->db->select('*');
               // $this->db->distinct();
                if($where):
                    $this->db->where($where);
                endif;
            
                    $this->db->order_by($value,'asc');
                
                
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
        
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Upload Images ---------------------------------------------------------->
    //---------------------------------------------------------------------------------------------------------->
    public function uploadDirectory($file_name,$dir)
    {
        $config = array(
            'upload_path'=> $dir.'/',
            'allowed_types'=>'jpg|jpeg|png',
            'max_size'=>'100'
        );

        $this->load->library('upload', $config);
        $this->upload->do_upload($file_name);
        $data=$this->upload->data();
        return $data;
    }
    //---------------------------------------------------------------------------------------------------------->
    //----------------------------------Upload Images ---------------------------------------------------------->
    //---------------------------------------------------------------------------------------------------------->   
    public function do_resize_only($path){
    
    $config['image_library'] = 'gd2';
    $config['source_image'] = $path;
    $config['create_thumb'] = TRUE;
    $config['maintain_ratio'] = TRUE;
    $config['width']     = 300;
    $config['height']   = 250;

    
    $this->image_lib->initialize($config);
    $this->image_lib->resize();
          $this->image_lib->resize();
        
    }
public function do_resize_gallery($file_name,$dir,$size=NULL){
    
        $this->load->library( array('image_lib') );
        $configUp['upload_path']    = $dir.'/';
        $configUp['allowed_types']  = 'jpg|jpeg|png|gif|mp4|3gp|flv|mp3|doc|docx|rar';
        $configUp['max_size']       = '900000000000';
        
        $this->load->library('upload', $configUp);
        $this->upload->do_upload($file_name);
        $data                       = $this->upload->data();
        $imageName                  = $data['file_name'];
        $path                       = $dir.'/'.$imageName;
        $config['image_library']    = 'gd2';
        $config['source_image']     = $path;
        $config['create_thumb']     = TRUE;
        $config['thumb_marker']     = '_thumb';
        $config['maintain_ratio']   = TRUE;
        
        $config['width']            = 200;
        $config['height']           = 1500;
       
       

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
      

        unlink($path);

        $result = array(
            'file_name'=>$data['raw_name'].$config['thumb_marker'].$data['file_ext']
        );
         
        return  $result;
        
    }
    
    public function hr_do_resize($file_name=NULL,$dir=NULL){
    
        if(empty($dir)):
            $dir = 'assets/images/';
        endif;
        $this->load->library( array('image_lib') );
        $configUp['upload_path']    = $dir.'/';
        $configUp['allowed_types']  = 'jpg|jpeg|png|gif|mp4|3gp|flv|mp3|doc|docx|rar';
        $configUp['max_size']       = '900000000000';
            
        if(!empty($file_name)):
         $this->load->library('upload', $configUp);
        $this->upload->do_upload($file_name);
        $data                       = $this->upload->data();
        $imageName                  = $data['file_name'];
        $path                       = $dir.'/'.$imageName;
        $config['image_library']    = 'gd2';
        $config['source_image']     = $path;
        $config['create_thumb']     = TRUE;
        $config['thumb_marker']     = '_thumb';
        $config['maintain_ratio']   = TRUE;
        $config['width']            = 250;
        $config['height']           = 300;

        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->resize();

        unlink($path);

        $result = array(
            'file_name'=>$data['raw_name'].$config['thumb_marker'].$data['file_ext']
        );
         
        return  $result;
        endif;
       
        
    }
 
    public function get_where_result_like($table,$where){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->like($where)
                         ->get();
            return $query->result();
   }
   
    public function get_where_like($table,$where,$like){
        $query =$this->db->SELECT('*')
                         ->FROM($table)
                         ->where($where)
                         ->like($like)
                         ->get();
            return $query->result();
   }
   
public function getHrRcords(){
       $query = $this->db->select(
               '  
                  student_record.form_no,
                  student_record.student_name,  
                  student_record.father_name, 
                  applicant_edu_detail.obtained_marks,
                  applicant_edu_detail.total_marks,
                  
                  applicant_edu_detail.percentage,
                  sub_programes.name as sub_Programe_name,
                  reserved_seat.name as reserved_seat_name,
                  domicile.name as domicileName,
    
                  student_record.fata_school as School_Status,
                  
                  '
                )
 
                ->from('student_record')
                ->join('applicant_edu_detail','applicant_edu_detail.student_id=student_record.student_id','left outer')
                ->join('sub_programes','sub_programes.sub_pro_id=student_record.sub_pro_id','left outer')
                ->join('reserved_seat','reserved_seat.rseat_id=student_record.rseats_id','left outer')
                ->join('domicile','domicile.domicile_id=student_record.domicile_id','left outer')
                ->where('student_record.rseats_id','7')
                //->where('student_record.sub_pro_id','5')
                //->where('student_record.fata_school','yes')
                ->order_by('applicant_edu_detail.percentage','desc')
                ->get();
   
       return $query->result();
   } 

   

    
    public function get_max_where($id,$table){
        
        $this->db->select_max($id);
        $query = $this->db->get($table);
        return $query->row();
    }
    
    public function get_max_value($id,$table,$where=NULL){
                $this->db->select('*');
                $this->db->from($table);
                if($where):
                    $this->db->where($where);
                endif;
                $this->db->limit('1');
                $this->db->order_by($id,'desc');
        return  $this->db->get()->row();
    }
    
    public function get_max_valueCode($id,$table){
                $this->db->select('*');
                $this->db->from($table);
                $this->db->limit('1');
                $this->db->order_by($id,'desc');
        return  $this->db->get()->row();
    }
       public function key_exists($table,$where){
    $this->db->where($where);
    $query = $this->db->get($table);
    if ($query->num_rows() > 0){
        return true;
    }
    else{
        return false;
    }
    }
    
    
     public function money_convert($number){
        
            $no = round($number);
            $point = round($number - $no, 2) * 100;
            $hundred = null;
            $digits_1 = strlen($no);
            $i = 0;
            $str = array();
            $words = array('0' => '', '1' => 'one', '2' => 'two',
             '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
             '7' => 'seven', '8' => 'eight', '9' => 'nine',
             '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
             '13' => 'thirteen', '14' => 'fourteen',
             '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
             '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
             '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
             '60' => 'sixty', '70' => 'seventy',
             '80' => 'eighty', '90' => 'ninety');
            $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
            while ($i < $digits_1) {
              $divider = ($i == 2) ? 10 : 100;
              $number = floor($no % $divider);
              $no = floor($no / $divider);
              $i += ($divider == 10) ? 1 : 2;
              if ($number) {
                 $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                 $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                 $str [] = ($number < 21) ? $words[$number] .
                     " " . $digits[$counter] . $plural . " " . $hundred
                     :
                     $words[floor($number / 10) * 10]
                     . " " . $words[$number % 10] . " "
                     . $digits[$counter] . $plural . " " . $hundred;
              } else $str[] = null;
           }
           $str = array_reverse($str);
           $result = implode('', $str);
           $points = ($point) ?
             "." . $words[$point / 10] . " " . 
                   $words[$point = $point % 10] : '';
           if($points):
               return  "Rupees  " .$result . $points . " Paise";
           else:
               
               if($result):
                    return  "Rupees  " .$result ;
                   else:
                    return '';
               endif;
             
           
           endif;

     }
     public function categroy(){
         
         // I have three table memu1,menu2 and menu3
         
         
         $menu1 = $this->db->get_where('menul1',array('m1_status'=>1))->result();
         $result = '';
         foreach($menu1 as $m1):
             
             
             $menu2 = $this->db->get_where('menul2',array('m2_status'=>1,'m2_m1Id'=>$m1->m1_id))->result();
                    foreach($menu2 as $m2):
                            
                 $menu3 =$this->db->select('m3_name')->get_where('menul3',array('m3_status'=>1,'m3_m2Id'=>$m2->m2_id))->result();
                 
                 $result[] = array(
                     'menu1_title' =>$m1->m1_name,
                     'menu2'       =>$m2->m2_name,
                     'menu3'       =>$menu3,
                 );
             
             endforeach;
         
             
         endforeach;
         
          return   json_decode(json_encode($result), FALSE);
         
     }
     
     
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
	public function slugify($text){
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
          return 'n-a';
        }

        return $text;
      }
}
