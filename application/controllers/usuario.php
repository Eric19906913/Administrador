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

    $resultado = $this->usuario->verificar($usuario);
    if(password_verify($contraseña, $resultado->result()[0]->contraseña)){
      $data = array(
        'usuario' => $resultado->result()[0]->usuario,
        'email' => $resultado->result()[0]->email,
        'log' => true,
        'mensaje' => 'Bienvenido'
      );
      $this->session;
      $this->session->set_userdata($data);
      echo json_encode($data);
    }else{
      $data = array(
        'mensaje' => 'La contraseña es incorrecta',
        'log' => false
      );
      echo json_encode($data);
    }

    }

  public function registro(){
    $usuario = $this->input->post('usuario');
    $email = $this->input->post('email');
    $contraseña = $this->input->post('contraseña');

    $pass_cypher = password_hash($contraseña, PASSWORD_BCRYPT, ['cost'=>4]);
    $query = $this->usuario->registrar($usuario, $email, $pass_cypher);
    if($query == 0){
      $data = array(
        'mensaje' => 'Usuario creado con exito',
        'creado' => true
      );
      echo json_encode($data);
    }else{
      $data = array(
        'mensaje' => 'El usuario ya existe!',
        'creado' => false
      );
      echo json_encode($data);
    }
  }

  public function recuperar(){
    $usuario = $this->input->post('usuario');
    $email = $this->input->post('email');
    $contraseña = $this->input->post('contraseña');
    $pass_cypher = password_hash($contraseña, PASSWORD_BCRYPT, ['cost'=>4]);
    $query = $this->usuario->resetpass($usuario, $email, $pass_cypher);

    if($query == 0){
      $data = array(
        'mensaje' => 'Ocurrio un error',
        'cambio' => false
      );
      echo json_encode($data);
    }else{
      $data = array(
        'mensaje' => 'Contraseña cambiada con exito',
        'cambio' => true
      );
      echo json_encode($data);
    }
  }

}

?>
