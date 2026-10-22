<?php
  
require_once("conexion.model.php");

class TorneoModel{

    public static function mdlMostrarTorneoRecientesLimit($tabla, $limit)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla ORDER BY fecha_inicio DESC LIMIT $limit");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    public static function mdlSacarTorneo($tabla, $campo, $id)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE $campo LIKE '$id'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

}