<!doctype html>
<html lang="en">
  <head>
    <?php include_once('Assets/header.php') ?>

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
            <h2>Administrador</h2>
            <p>Ingrese usuario y contraseña</p>
          </div>
          <form id="Login" >
            <div class="form-group">
              <input type="text" class="form-control" id="usuario" placeholder="Nombre de usuario">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="contraseña" placeholder="Contraseña">
            </div>
            <div class="forgot">
              <a href="home/resetPass">Olvido su contraseña?</a>
            </div>
            <button type="button" class="btn btn-primary" name="button" onclick="login()">Ingresar</button>
          </form>
        </div>
      </div>
    </div>
</body>
<script>
  function login(){

    var usuario = document.getElementById('usuario').value;
    var contraseña = document.getElementById('contraseña').value;
    if(usuario === "" || contraseña === ""){
      swal({ text:'Debe completar todos los campos',
            icon: "warning"
          });

    }else{
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>usuario/log',
      dataType: 'JSON',
      data:{
        usuario:usuario,
        contraseña:contraseña
      },
      success: function(nombre){
        swal({
          title:'Bienvenido '+nombre,
          icon: 'success'
          });
          window.location.href = '<?php echo base_url() ?>direccion'
      },
      error: function(){
        swal({
          title: 'No existe el usuario ingresado',
          icon: 'warning'
        });

      },
    });



  }
}
</script>
</html>
