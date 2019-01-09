<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario_model extends CI_Model{
 var $table ="administrador";
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function verificar($usuario, $contraseña){

    $this->db->select('usuario');
    $this->db->select('contraseña');
    $this->db->where('usuario',$usuario);
    $this->db->where('contraseña',$contraseña);

    $dato = $this->db->get('administrador');
    $resultado = $dato->num_rows();
    if($resultado > 0){
      foreach($dato as $r){
        $data = array(
          'username' => $usuario,
          'logged' =>TRUE
        );

      }
      $session = $this->session->set_userdata($data);
      $nombre = $this->session->userdata('username');
      echo json_encode($nombre);
    }else{
        return error();
      }


  }
  public function registrar($usuario, $email, $contraseña){
    $this->db->select('usuario');
    $this->db->where('usuario',$usuario);
    $dato = $this->db->get('administrador');
    $resultado = $dato->num_rows();
    //echo $resultado;
    if($resultado == 0){

      $data = array(
        'usuario' => $usuario,
        'email' => $email,
        'contraseña'=>$contraseña
      );
      $this->db->insert('administrador',$data);
    }else{
      return error();
    }
  }
  public function resetpass($usuario, $email, $contraseña){
    $this->db->select('usuario');
    $this->db->select('email');
    $this->db->where('usuario',$usuario);
    $this->db->where('email',$email);

    $dato = $this->db->get('administrador');
    $resultado = $dato->num_rows();

    if($resultado == 1){

      $data = array(
        'usuario' =>$usuario,
        'email' =>$email,
        'contraseña'=>$contraseña
      );

      $this->db->where('usuario',$usuario);
      $this->db->where('email',$email);
      $this->db->update('administrador',$data);
    }else{
      return error();
    }
  }
}

?>
