<?php
  
class TorneoController{


    public function ctrMostrarTorneoRecientesLimit($limit)
    {
        $tabla = "torneo";
        $respuesta = TorneoModel::mdlMostrarTorneoRecientesLimit($tabla, $limit);

        return $respuesta;
    }

}