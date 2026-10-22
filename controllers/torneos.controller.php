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

    public function ctrSacarTotalAsistentes($id)
    {
        $tabla = "torneo_jugador";
        $campo = "id_torneos";
        $total = TorneoModel::Total_registros($tabla, $campo, $id);
        return $total;
    }

}