<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php
    //Verificaion de usuario
      if(!isset($_SESSION['usuario'])){
        //header('Location: home');
      }else{
        $this->session;
        $nombre = $this->session->userdata('usuario');
      }
      include_once('Assets/header.php');
     ?>
    <meta charset="utf-8">
    <title>Perfil de <?php echo $nombre ?></title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item active">
            <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="administrador/registro">Registrar usuario</a>
          </li>
          <li>
            <button onclick="logout()"><a class="navbar-brand">Salir</a></button>
          </li>
          <li>
            <button class="btn btn-default" onclick="reload_table()"><i class="fas fa-redo"></i></button>
          </li>

        </ul>
      </div>
    </nav>


    <br>
    <br>

    <div class="" id='Hora'>
      <table id="horarios" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <th>DNI</th>
          <th>Nombre</th>
          <th>Hora de ingreso</th>
          <th>Hora de egreso</th>
          <th>Observaciones</th>
          <th style="width:125px;">Acción</th>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </body>
  <script>
  var table;
  var save_method;

  jQuery(document).ready(function($){ //funcion para crear datatables
      table = $('#horarios').DataTable({

          buttons: [
            'excel','pdf',
          ],
          dom: 'lftBrip',
          "ajax": {
              url : "<?php echo base_url() ?>horarios/ajax_listado",
              type : 'GET'
          },
          language: {
              "sProcessing":     "Procesando...",
              "sLengthMenu":     "Mostrar _MENU_ registros",
              "sZeroRecords":    "No se encontraron resultados",
              "sEmptyTable":     "Ningún dato disponible en esta tabla",
              "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
              "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
              "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
              "sInfoPostFix":    "",
              "sSearch":         "Buscar:",
              "sUrl":            "",
              "sInfoThousands":  ",",
              "sLoadingRecords": "Cargando...",
              "oPaginate": {
                  "sFirst":    "Primero",
                  "sLast":     "Último",
                  "sNext":     "Siguiente",
                  "sPrevious": "Anterior"
              },
              "oAria": {
                  "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                  "sSortDescending": ": Activar para ordenar la columna de manera descendente"
              }
          }
      });
  });


  function delete_horario(id){
      if(confirm('¿Desea borrar los datos seleccionados?'))
      {
          // ajax delete data to database
          $.ajax({
              url : "<?php echo base_url('horarios/ajax_delete')?>/"+id,
              type: "POST",
              dataType: "JSON",
              success: function(data)
              {
                  swal("Aviso", "Datos eliminados con éxito.", "success");
                  //if success reload ajax table


                  reload_table();
              },
              error: function (jqXHR, textStatus, errorThrown)
              {
                  var mensaje = "Error borrando el horario";
                  if(jqXHR.responseText){
                      mensaje = jqXHR.responseText;
                  }
                  if(mensaje != ""){
                      swal("Aviso", mensaje, "warning");
                  }
              }
          });

      }
  }
  function reload_table(){
      table.ajax.reload(null,false); //reload datatable ajax
  }


  function update_observacion(id){
      swal({
        title: 'Ingrese una observacion:',
        content: {
          element: "input",
        },
      }).then(value =>{
          var observacion = value;
          $.ajax({
            type:'POST',
            data:{
              observacion: observacion,
            },
            url: '<?php echo base_url('horarios/observacion') ?>/'+id+'/'+observacion,
            success:function(){
              swal({
                title: 'Se agrego la observacion',
                icon: 'success'
              });
              reload_table();
            },
            error:function(){
              if(observacion === ""){
                  swal("No se agrego ninguna observacion!");
              }else{
              swal({
                title:'ocurrio un error',
                icon: 'warning'

              });
            }
            },

          });
        });

      }
      function logout(){
        $.ajax({
          type:'POST',
          url: '<?=base_url('administrador/logout')?>',
          success:function(){
            window.location.href = '<?=base_url('/home')?>' 
          },
          error:function(){
            alert('todo roto');
          },
        })
      }

  </script>
</html>
