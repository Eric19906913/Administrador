<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrador extends CI_Controller {

    public function index(){
      $this->load->view('administrador');

    }
    public function registro(){
      $this->load->view('registro');
    }
    public function logout(){
    	$this->session->sess_destroy();
    	$this->load->view('login');
    }


}

?>
