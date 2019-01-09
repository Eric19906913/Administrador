<?php
  $this->session;
  $usuario = $this->session->userdata('username');
    if(isset($_SESSION['username'])){
      echo "bienvenido $usuario";
      session_destroy();
      header('Location: home');
    }else{
      echo 'Ups! no deberias estar aqui! <a href="home" >Ingresa!</a>';
    }
?>
