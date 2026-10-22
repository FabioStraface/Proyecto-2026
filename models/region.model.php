<?php
  
require_once("conexion.model.php");

class RegionModel {

    public static function mdlSacarRegion($tabla, $id)/*Sacar registros mediante el id*/
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE id LIKE '$id'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    public static function mdlSacarRegiones($tabla)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

}