<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

  public function __construct() {
    Parent::__construct();
    $this->load->model("usuario_model","usuario"); //pseudonimo para modelo
  }

  public function log(){
    $usuario = $this->input->post('usuario');
    $contraseña = $this->input->post('contraseña');

    $this->usuario->verificar($usuario, $contraseña);
    }

  public function registro(){
    $usuario = $this->input->post('usuario');
    $email = $this->input->post('email');
    $contraseña = $this->input->post('contraseña');

    $this->usuario->registrar($usuario, $email, $contraseña);
  }

  public function recuperar(){
    $usuario = $this->input->post('usuario');
    $email = $this->input->post('email');
    $contraseña = $this->input->post('contraseña');

    $this->usuario->resetpass($usuario, $email, $contraseña);
  }

}

?>
