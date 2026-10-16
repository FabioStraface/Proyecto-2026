<?php
  
  class Conexion{
    public static function conectar()
    {
        try {
            $dns = "mysql:host=localhost;dbname=torneos;charset=utf8";
            $conexion = new PDO($dns, "root", "");
        } catch (PDOException $e) 
        {
            echo $e->getMessage();
            exit;
        }
        return $conexion;
    }
}