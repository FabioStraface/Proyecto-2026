<?php
  
class TorneoController{


    public function ctrMostrarTorneoRecientesLimit($limit)
    {
        $tabla = "torneo";
        $respuesta = TorneoModel::mdlMostrarTorneoRecientesLimit($tabla, $limit);

        return $respuesta;
    }

    public function ctrSacarTorneo($id)
    {
        $tabla = "torneo";
        $campo = "id_torneo";
        $respuesta = TorneoModel::mdlSacarTorneo($tabla,$campo,$id);
        return $respuesta;
    }

}