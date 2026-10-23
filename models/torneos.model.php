<?php
  
require_once("conexion.model.php");

class TorneoModel{

    //Creo mi propio array orientado a objetos
    //public $MiSeed = [];

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

    public static function Total_registros($tabla, $campo, $id)
    {
        $conexion = Conexion::conectar();
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM $tabla WHERE $campo LIKE '$id'";
        $registros = $conexion->query($consulta);
        $total = $registros->rowCount();
        return $total;
    }

    public static function mdlSacarRegistrosDelTorneoEspecifico($tabla, $campo, $id)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE $campo LIKE '$id' ORDER BY seed DESC");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    public static function mdlSacarRegistroEspecifico($tabla, $campo, $id)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE $campo LIKE '$id'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

}