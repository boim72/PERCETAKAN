<?php
defined('BASEPATH') OR exit ('No direct scrit access allowerd');

class Landingpage extends CI_Controller{
    
    public function index(){
        $this->load->view('Landingpage/index');
       
    }
}


?>