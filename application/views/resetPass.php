<!doctype html>
<html lang="en">
  <head>
    <?php require_once('includes/header.php') ?>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?php base_url('Assets/estilo.css') ?>" type="text/css">
    <title>Bienvenido!</title>
  </head>
  <body id="LoginForm">
    <div class="container">
      <h1 class="form-heading">E.E.T. Ana Urquiza</h1>
      <div class="login-form">
        <div class="main-div">
          <div class="panel">
            <h2>Recuperar contraseña</h2>
            <p></p>
          </div>
          <form id="Login" >
            <div class="form-group">
              <input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario">
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="email" placeholder="Correo electronico">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="contraseña" placeholder="Nueva contraseña">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="confirmacontraseña" placeholder="Confirmar contraseña">
            </div>
            <div class="forgot">
              <a href="<?=base_url('home')?>">Salir</a>
            </div>
            <button type="button" class="btn btn-primary" name="button" onclick="recuperar()">Confirmar cambio</button>
          </form>
        </div>
      </div>
    </div>
</body>
<script>
  function recuperar(){

    var usuario = document.getElementById('usuario').value;
    var email = document.getElementById('email').value;
    var contraseña = document.getElementById('contraseña').value;
    var confirmacontraseña = document.getElementById('confirmacontraseña').value;
    if(usuario === "" || contraseña === "" || email === "" || confirmacontraseña === ""){
      swal({ text:'Debe completar todos los campos',
            icon: "warning"
          });

    }else if(contraseña != confirmacontraseña){
      swal({
        text:'Las contraseñas ingresadas no coinciden',
        icon: "warning"
      });
    }else{
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>usuario/recuperar',
      data:{
        usuario:usuario,
        email:email,
        contraseña:contraseña

      },
      success: function(data){
        var datalert = JSON.parse(data);
        if(datalert.cambio == true){
          swal({
            title:datalert.mensaje,
            icon: 'success'
          });  
        }else{
          swal({
            title:datalert.mensaje,
            icon: 'warning'
          });
        }
        
      },
      error: function(){
        alert('Error');
      },
    });



  }
}
</script>
</html>
