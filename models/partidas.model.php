<?php
  
require_once("conexion.model.php");

class PartidasModel{

    static public function mdlIngresarPartidaPreliminar($tabla,$datos)
    {
       $conexion = Conexion::conectar();
       $sentencia = $conexion->prepare("INSERT INTO $tabla(id_jugador1, id_jugador2, id_torneo, ronda, pools)
       VALUES (?, ?, ?, ?, ?)");

       $respuesta = $sentencia->execute(array($datos['jugador1'], $datos['jugador2'], $datos['id_Torneo'], $datos['ronda'], $datos['pools']));

       return $respuesta;
       
       $sentencia->close();
       $sentencia = null;
    }

    public static function mdlSacarPartida($tabla, $datos)/*Sacar registros de la partida mediante varios datos*/
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE 
        id_torneo LIKE '{$datos['id_Torneo']}' AND
        ronda LIKE '{$datos['ronda']}' AND
        pools LIKE '{$datos['pools']}'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

}