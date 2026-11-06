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

    public static function mdlSacarSeedTorneo($tabla, $campo, $seed, $id)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE $campo LIKE '$id' AND seed LIKE '$seed'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       SACAR LA SEED DE UN JUGADOR DENTRO DE UN TORNEO
       Hace falta en semifinales / losers, cuando ya no recorremos
       el seeding original sino el ganador o perdedor de una ronda.
       ============================================================ */
    public static function mdlSacarSeedJugador($tabla, $idJugador, $idTorneo)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE id_torneos LIKE '$idTorneo' AND id_jugador LIKE '$idJugador'");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       CERRAR EL TORNEO
       estado = 1 (true) significa que ya hay campeon:
       o gano el de G en H, o se jugo el reset X.
       ============================================================ */
    public static function mdlCerrarTorneo($tabla, $idTorneo)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE $tabla SET estado = 1 WHERE id_torneo LIKE ?");
        $respuesta = $sentencia->execute(array($idTorneo));
        return $respuesta;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       INSCRIBIR JUGADOR (O NPC) EN UN TORNEO
       ============================================================ */
    public static function mdlInscribirJugador($idTorneo, $idJugador, $seed)
    {
        $conexion = Conexion::conectar();
        /* fecha_inscripcion = ahora; el NPC se apunta al rellenar plazas */
        $sentencia = $conexion->prepare("INSERT INTO torneo_jugador(id_torneos, id_jugador, seed, fecha_inscripcion) VALUES (?, ?, ?, NOW())");
        $respuesta = $sentencia->execute(array($idTorneo, $idJugador, $seed));

        return $respuesta;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       CAMBIAR LA SEED DE UN INSCRITO
       Tras meter NPCs reordeno a todos por puntuacion.
       ============================================================ */
    public static function mdlActualizarSeed($idTorneo, $idJugador, $seed)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("UPDATE torneo_jugador SET seed = ? WHERE id_torneos LIKE ? AND id_jugador LIKE ?");
        $respuesta = $sentencia->execute(array($seed, $idTorneo, $idJugador));

        return $respuesta;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       INSCRITOS CON SU PUNTUACION (PARA REHACER EL SEED)
       ============================================================ */
    public static function mdlSacarInscritosConPuntos($idTorneo)
    {
        $conexion = Conexion::conectar();
        /* fecha_inscripcion sale con el inscrito para ordenar Participantes */
        $consulta = $conexion->query("SELECT tj.id_jugador, tj.seed, tj.fecha_inscripcion, j.usuario, j.img, COALESCE(j.puntuacion, 0) AS pts FROM torneo_jugador tj
        INNER JOIN jugador j ON j.id = tj.id_jugador
        WHERE tj.id_torneos LIKE '$idTorneo'");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

}