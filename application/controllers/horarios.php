<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Horarios extends CI_Controller {

    public function __construct() {
      Parent::__construct();
      $this->load->model("horarios_model","hora"); //esto sirve para ponerle un pseudonimo a al modelo con el que se desea trabajar
    }
    public function ajax_listado(){
        $resultados = $this->hora->get_datatables();

        $data = array();
        foreach($resultados->result() as $resultado) { //se crea un array asociativo con cada resultados de la consulta a la BDD
            $accion = '<a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Borrar" onclick="delete_horario('."'".$resultado->id."'".')"><i class="fas fa-trash"></i></a>
                      <a class="btn btn-sm btn-edit" href="javascript:void(0)" title="Editar Observacion" onclick="update_observacion('."'".$resultado->id."'".')"><i class="fas fa-marker"></i>';

            $data[] = array(
                $resultado->DNI,
                $resultado->nombre,
                $resultado->horaingreso,
                $resultado->horaegreso,
                $resultado->observaciones,
                $accion
            );
        }

        $output = array(
            "recordsTotal" => $resultados->num_rows(),
            "recordsFiltered" => $resultados->num_rows(),
            "data" => $data // se establecen la cantidad de resultados y los filtros
        );
        echo json_encode($output); // se envian los filtros y los resultados por JSON junto con el array que contiene los datos
        exit();
    }
    public function ajax_delete($id){ // funcion para borrar por id
        $datos_Consulta = $this->hora->get_by_id($id); // pide los ID dentro de la tabla

        $this->hora->delete_by_id($id);
        echo json_encode(array("status" => TRUE)); //devuelvo true al estado de eliminacion
      }

      public function observacion($id,$observacion){
        $observaciones = str_replace('%20', ' ', $observacion);
        $this->hora->agregaobservacion($id,$observaciones);

    }
}
?>
