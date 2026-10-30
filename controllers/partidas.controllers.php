<?php
  
class PartidasController{

    public function ctrCrearPartidaPreliminar($jugador1, $jugador2, $idTorneo, $ronda, $pools)
    {
        $tabla = "partidas";

        $datos = array("jugador1" => $jugador1,
                        "jugador2" => $jugador2,
                        "id_Torneo" => $idTorneo,
                        "pools" => (int) $pools,
                        "ronda" => $ronda);

        $partida = PartidasModel::mdlSacarPartida($tabla, $datos);

        if (!$partida) 
        {
            $respuesta = PartidasModel::mdlIngresarPartidaPreliminar($tabla, $datos);
        }
    }

    public function ctrBuscarSiEstasReportado($idTorneo, $ronda, $pools)
    {
        $tabla = "partidas";

        $datos = array("id_Torneo" => $idTorneo,
                        "pools" => (int) $pools,
                        "ronda" => $ronda);

        $partida = PartidasModel::mdlSacarPartida($tabla, $datos);

        return $partida['ganador'];

    }

    public function ctrReportar()
    {
        if (isset($_POST['game1']))
        {
            return "entra";
        }
        else 
        {
            return "no entra";
        }

    }

}