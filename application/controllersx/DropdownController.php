<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once(APPPATH.'core/AdminController.php');
 

class DropdownController extends AdminController {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/roufee_new_headtes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
      
          
    public function __construct() {
             parent::__construct();
             
 
          }
          
    
    public function getPaymentCategory(){
        $sectionId = $this->input->post('sub_program_id');
        $where = array('sub_programes.sub_pro_id'=>$sectionId);
        $getResult = $this->DropdownModel->get_Payment_Category($where);
       echo '<option value="">Select</option>';
        foreach($getResult as $secRow):
               echo '<option value="'.$secRow->pc_id.'">'.$secRow->title.'('.$secRow->name.' '.$secRow->batch_name.')</option>';
        endforeach;
    }
          //Hostel Student Auto compelete
    public function autoComplete_student_info(){
            $term = trim(strip_tags($this->input->get('term')));
            if( $term == ''){
                $like           = $term;
                $result_set     = $this->DropdownModel->add_extra_heads(array(5,9));
                $labels         = array();
                    foreach ($result_set as $row_set) {
                        $labels[]       = array( 
                            
                            'label'     =>$row_set->college_no.','.$row_set->student_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'      =>$row_set->student_id, 
                            'value'     =>$row_set->college_no, 
                            'name'      =>$row_set->student_name, 
                            'f_name'    =>$row_set->father_name, 
                              
                    );
                }
            $matches    = array();
                foreach($labels as $label){
                    $label['label']     = $label['label']; 
                    $label['code']      = $label['code'];
                    $label['value']     = $label['value'];
                    $label['name']      = $label['name'];
                    $label['f_name']    = $label['f_name'];
                    
                    
                    $matches[]          = $label;
            }
            $matches                    = array_slice($matches, 0, 10);
                echo  json_encode($matches); 
            }else if($term != ''){
                $like                   = $term;
                $result_set             = $this->DropdownModel->add_extra_heads(array(5,9),$like);
                $labels                 = array();
                    foreach ($result_set as $row_set) {
                    $labels[]           = array( 
                           'label'     =>$row_set->college_no.','.$row_set->student_name.' ,Form# '.$row_set->form_no.' ', 
                            'code'      =>$row_set->student_id, 
                            'value'     =>$row_set->college_no, 
                            'name'      =>$row_set->student_name, 
                            'f_name'    =>$row_set->father_name,
                    );
             }
            $matches                = array();
            foreach($labels as $label){
                    $label['label']     = $label['label']; 
                    $label['code']      = $label['code'];
                    $label['value']     = $label['value'];
                    $label['name']      = $label['name'];
                    $label['f_name']    = $label['f_name']; 
                   
                    $matches[]          = $label;
            }
                $matches                = array_slice($matches, 0, 10);
            echo  json_encode($matches); 
            }
        }
 

    }

