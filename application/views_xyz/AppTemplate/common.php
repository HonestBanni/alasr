<?php
 
$this->load->view('AppTemplate/header');
$this->load->view('AppTemplate/nav');
$this->load->view($page_name);
$this->load->view('AppTemplate/footer');

?>