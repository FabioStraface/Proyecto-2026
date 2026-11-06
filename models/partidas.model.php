<?php
  
require_once("conexion.model.php");

class PartidasModel{

    /* ============================================================
       INSERTAR ENFRENTAMIENTO PRELIMINAR
       Se crea la fila vacía (sin game, sin ganador, sin personajes)
       para reservar el combate en el cuadro.
       ============================================================ */
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

    /* ============================================================
       SACAR UNA FILA DEL ENFRENTAMIENTO
       Sirve sobre todo para detectar si ya existe el preliminar
       (o cualquier fila de esa ronda + pool).
       ============================================================ */
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

    /* ============================================================
       SACAR LOS GAMES YA REPORTADOS DEL SET
       Solo filas con número de game (1 a 5). El preliminar no entra.
       ============================================================ */
    public static function mdlSacarPartidasConGames($tabla, $datos)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE 
        id_torneo LIKE '{$datos['id_Torneo']}' AND
        ronda LIKE '{$datos['ronda']}' AND
        pools LIKE '{$datos['pools']}' AND
        game IS NOT NULL
        ORDER BY game ASC");
        $registros = $consulta->fetchAll();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       BORRAR EL ENFRENTAMIENTO PRELIMINAR
       Se elimina la fila reservada (game IS NULL) antes de
       insertar los games reales del reporte.
       ============================================================ */
    static public function mdlBorrarPartidaPreliminar($tabla, $partida)
    {
        $conexion = Conexion::conectar();
        $sentencia = $conexion->prepare("DELETE FROM $tabla WHERE
        id_torneo LIKE ? AND
        ronda LIKE ? AND
        pools LIKE ? AND
        game IS NULL");

        $respuesta = $sentencia->execute(array($partida['id_Torneo'], $partida['ronda'], $partida['pools']));

        return $respuesta;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       INSERTAR LOS GAMES DEL REPORTE
       1) Borra el preliminar
       2) Inserta una fila por cada game jugado (3, 4 o 5)
          con personajes, ganador y puntuacion_conseguida
       ============================================================ */
    static public function mdlIngresarPartida($tabla,$datos,$partida)
    {
        $conexion = Conexion::conectar();

        /* Primero borro el enfrentamiento preliminar creado antes */
        PartidasModel::mdlBorrarPartidaPreliminar($tabla, $partida);

        /* Calculo cuantos games se han enviado (best of 5, first to 3) */
        $u = 3;

        if (isset($datos['game4']) && isset($datos['game5'])) 
        {
            $u = 5;
        }
        elseif (isset($datos['game4'])) 
        {
            $u = 4;
        }

        /* Ahora reporto todos los games uno a uno */
        for ($i=1; $i <= $u ; $i++) 
        { 
             $sentencia = $conexion->prepare("INSERT INTO $tabla(id_jugador1, id_personaje1, id_jugador2, id_personaje2,
            id_torneo, puntuacion_conseguida, ronda, game, pools, ganador)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

            /* p1 gana el game: jugador1 es el ganador de esta fila */
            if ($datos['game'. $i] == "p1") 
            {
                $ganadorGame = $partida['jugador1'];
            }
            else 
            {
                $ganadorGame = $partida['jugador2'];
            }

            $respuesta = $sentencia->execute(array(
                $partida['jugador1'],
                $datos['game'.$i.'_p1_char'],
                $partida['jugador2'],
                $datos['game'.$i.'_p2_char'],
                $partida['id_Torneo'],
                $datos['puntos_game'.$i],
                $partida['ronda'],
                $i,
                $partida['pools'],
                $ganadorGame
            ));
        }

        return $respuesta;
        
        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       ÚLTIMO GAME REPORTADO DE UN JUGADOR EN ESTE TORNEO
       Sirve para preseleccionar el personaje que ya usó.
       ============================================================ */
    public static function mdlSacarUltimoGameJugador($tabla, $idJugador, $idTorneo)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE
        id_torneo LIKE '$idTorneo' AND
        game IS NOT NULL AND
        (id_jugador1 LIKE '$idJugador' OR id_jugador2 LIKE '$idJugador')
        ORDER BY id DESC LIMIT 1");
        $registros = $consulta->fetch();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       GAMES REPORTADOS DE UN JUGADOR EN TODO EL TORNEO
       Traigo tambien el id para saber el orden: el record del
       modal solo cuenta sets hasta ese enfrentamiento, no el final.
       ============================================================ */
    public static function mdlSacarGamesJugadorTorneo($tabla, $idJugador, $idTorneo)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT id, ronda, pools, ganador FROM $tabla WHERE
        id_torneo LIKE '$idTorneo' AND
        game IS NOT NULL AND
        (id_jugador1 LIKE '$idJugador' OR id_jugador2 LIKE '$idJugador')
        ORDER BY id ASC");
        $registros = $consulta->fetchAll();
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    /* ============================================================
       TODOS LOS GAMES REPORTADOS DEL TORNEO
       Los agrupo luego en PHP por ronda+pool para saber
       quien gano o perdio cada set (WINS / LOSSES).
       ============================================================ */
    public static function mdlSacarGamesTorneo($tabla, $idTorneo)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT id, ronda, pools, id_jugador1, id_jugador2, ganador FROM $tabla WHERE
        id_torneo LIKE '$idTorneo' AND
        game IS NOT NULL
        ORDER BY id ASC");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

}
