<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class usuario_model extends CI_Model{
 var $table ="administrador";
  public function __construct()
  {
      parent::__construct();
      $this->load->database();
  }

  public function verificar($usuario){
    $this->db->select();
    $this->db->where('usuario',$usuario);
    $query = $this->db->get($this->table, 1);
    return $query;
  }

  public function registrar($usuario, $email, $contraseña){
    $this->db->select('usuario');
    $this->db->where('usuario',$usuario);
    $dato = $this->db->get($this->table);
    $resultado = $dato->num_rows();
    //echo $resultado;
    if($resultado == 0){

      $data = array(
        'usuario' => $usuario,
        'email' => $email,
        'contraseña'=>$contraseña
      );
      $this->db->insert('administrador',$data);
      return $resultado;
    }else{
      return $resultado;
    }
  }
  public function resetpass($usuario, $email, $contraseña){
    $this->db->select('usuario');
    $this->db->select('email');
    $this->db->where('usuario',$usuario);
    $this->db->where('email',$email);

    $dato = $this->db->get($this->table);
    $resultado = $dato->num_rows();
    if($resultado == 1){
      $data = array(
        'usuario' =>$dato->result()[0]->usuario,
        'email' =>$dato->result()[0]->email,
        'contraseña'=>$contraseña
      );
      $this->db->set($data);
      $this->db->where('usuario',$usuario);
      $this->db->where('email',$email);
      $this->db->update($this->table);
      return $resultado;
    }else{
      return $resultado;
    }
  }
}

?>
