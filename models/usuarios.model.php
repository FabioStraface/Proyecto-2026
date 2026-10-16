<?php
  
require_once("conexion.model.php");

class UsuariosModel {

    public static function mdlSacarUsu($tabla, $id)/*Sacar registros del usuario mediante el id*/
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE id LIKE '$id'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    static public function mdlsacar_num_usuario($usuario,$password)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT usuario FROM jugador WHERE usuario='$usuario' AND pass='$password'");
        $contador = $consulta->rowCount();

        return $contador;
    }

    static public function mdlanadir_usu($usuario,$nombre,$apellidos,$password)
    {
        $conexion = Conexion::conectar();
        $sql = "INSERT INTO jugador(usuario, pass, nombre, apellidos) VALUES (?, ?, ?, ?)";
        $sentencia = $conexion->prepare($sql);
        $sentencia->execute(array($usuario,$password,$nombre,$apellidos));

        return $sentencia;
    }

    static public function mdlsacarIdUsu($usuario)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM jugador WHERE usuario LIKE '$usuario'");
        $registros = $consulta->fetch();
        $id_usu = $registros['id'];
        return $id_usu;
    }

    static public function mdlEditarUsu($tabla,$datos)
    {
       $conexion = Conexion::conectar();
 
       if ($conexion->exec("UPDATE $tabla SET usuario='".$datos['usuario']."', pass='".$datos['pass']."', img='".$datos['foto']."'
        WHERE id LIKE '".$datos['id']."'")) {
          return "SI";
       }else {
          return "Error";
       }
 
       $sentencia->close();
       $sentencia = null;
    }

}