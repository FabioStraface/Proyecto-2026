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

    /* ============================================================
       BUSCAR JUGADOR POR NICK (para reutilizar NPC1, NPC2...)
       ============================================================ */
    static public function mdlSacarUsuPorNick($usuario)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM jugador WHERE usuario LIKE '$usuario'");
        $registros = $consulta->fetch();

        return $registros;
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

    /* ============================================================
       SUMAR PUNTOS AL JUGADOR
       Se usa al reportar cada game: el ganador del game
       recibe puntuacion_conseguida en su total.
       ============================================================ */
    static public function mdlSumarPuntuacion($idJugador, $puntos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE jugador SET puntuacion = COALESCE(puntuacion, 0) + ? WHERE id LIKE ?");
        $respuesta = $sentencia->execute(array($puntos, $idJugador));

        return $respuesta;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       RESTAR PUNTOS (SUELO EN 0)
       Si un humano pierde un game contra un NPC, pierde
       entre 20 y 40 puntos de sorpresa.
       ============================================================ */
    static public function mdlRestarPuntuacion($idJugador, $puntos)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE jugador SET puntuacion = GREATEST(0, COALESCE(puntuacion, 0) - ?) WHERE id LIKE ?");
        $respuesta = $sentencia->execute(array($puntos, $idJugador));

        return $respuesta;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       CREAR UN NPC
       usuario NPC1, NPC2... puntuacion 0 para que su seed sea alta.
       ============================================================ */
    static public function mdlCrearNpc($usuario)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("INSERT INTO jugador(usuario, pass, nombre, apellidos, puntuacion, img, id_region)
        VALUES (?, ?, ?, ?, 0, 'default.png', 1)");
        $sentencia->execute(array($usuario, $usuario, $usuario, "NPC"));

        return $conexion->lastInsertId();

        $sentencia->close();
        $sentencia = null;
    }

}