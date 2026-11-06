<?php
  
class PartidasController{

    /* Recuerdo games y W-L por jugador+set para no repetir SQL en el cuadro */
    private $cacheGamesJugador = array();
    private $cacheRecordSets = array();

    /* ============================================================
       CREAR PARTIDA PRELIMINAR
       Si todavía no hay ninguna fila para esa ronda + pool,
       inserto el combate vacío para que exista en el cuadro.
       ============================================================ */
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

    /* ============================================================
       COMPROBAR SI EL SET YA ESTÁ REPORTADO
       Si hay filas con game, devuelvo el ganador de la primera.
       Si solo existe el preliminar (ganador NULL) o no hay nada,
       devuelvo null y el cuadro enseña el formulario.
       ============================================================ */
    public function ctrBuscarSiEstasReportado($idTorneo, $ronda, $pools)
    {
        $tabla = "partidas";

        $datos = array("id_Torneo" => $idTorneo,
                        "pools" => (int) $pools,
                        "ronda" => $ronda);

        $games = PartidasModel::mdlSacarPartidasConGames($tabla, $datos);

        if (!$games) 
        {
            return null;
        }

        return $games[0]['ganador'];

    }

    /* ============================================================
       ICONO DEL PERSONAJE
       Mientras no hay logos reales, el id del personaje se pinta
       con el mismo emoji que usa el formulario JS.
       ============================================================ */
    public function ctrIconoPersonaje($idPersonaje)
    {
        $iconos = array(
            1 => "😊",
            2 => "🍄",
            3 => "😎",
            4 => "🐶",
            5 => "🦸",
            6 => "🕷️",
            7 => "⚽"
        );

        if (isset($iconos[(int) $idPersonaje])) 
        {
            return $iconos[(int) $idPersonaje];
        }

        return "❔";
    }

    /* ============================================================
       ID DEL PERSONAJE MÁS USADO EN UNA LISTA
       Si hay empate (no hay mayoría), el primero de la lista
       (primer game del enfrentamiento).
       ============================================================ */
    public function ctrIdPersonajeMasUsado($listaIds)
    {
        if (!$listaIds) 
        {
            return "";
        }

        $conteo = array_count_values($listaIds);
        $maximo = max($conteo);
        $elegido = $listaIds[0];
        $empates = 0;

        foreach ($conteo as $id => $veces) 
        {
            if ($veces == $maximo) 
            {
                $empates++;
                if ($empates == 1) 
                {
                    $elegido = $id;
                }
            }
        }

        if ($empates > 1) 
        {
            $elegido = $listaIds[0];
        }

        return $elegido;
    }

    /* ============================================================
       PERSONAJE MÁS USADO EN EL SET (icono para la caja)
       ============================================================ */
    public function ctrPersonajeMasUsado($listaIds)
    {
        $id = $this->ctrIdPersonajeMasUsado($listaIds);
        if ($id === "") 
        {
            return "❔";
        }

        return $this->ctrIconoPersonaje($id);
    }

    /* ============================================================
       PUNTOS DE UN GAME (PREMIAR LA SORPRESA)
       Seed bajo = favorito. Si gana él, la ganancia es muy baja.
       Seed alto = underdog. Si gana él, los puntos suben con
       la diferencia de seeds (cuanto más raro, más puntos).
       ============================================================ */
    public function ctrCalcularPuntosGame($idGanador, $idJugador1, $idJugador2, $seed1, $seed2)
    {
        $seed1 = (int) $seed1;
        $seed2 = (int) $seed2;
        $diferencia = abs($seed1 - $seed2);
        if ($diferencia < 1) 
        {
            $diferencia = 1;
        }

        /* Seed del que ha ganado este game */
        if ($idGanador == $idJugador1) 
        {
            $seedGanador = $seed1;
            $seedRival = $seed2;
        }
        else 
        {
            $seedGanador = $seed2;
            $seedRival = $seed1;
        }

        /* Número de seed más bajo = favorito */
        if ($seedGanador < $seedRival) 
        {
            $puntos = 2;
        }
        else 
        {
            $puntos = 2 + $diferencia;
        }

        return $puntos;
    }

    /* ============================================================
       RESUMEN DEL SET PARA PINTAR EL CUADRO Y EL MODAL
       Devuelve games ganados, ganador, perdedor e iconos.
       ============================================================ */
    public function ctrSacarResumenSet($idTorneo, $ronda, $pools)
    {
        $tabla = "partidas";

        $datos = array("id_Torneo" => $idTorneo,
                        "pools" => (int) $pools,
                        "ronda" => $ronda);

        $games = PartidasModel::mdlSacarPartidasConGames($tabla, $datos);

        if (!$games) 
        {
            return array("reportado" => false);
        }

        $jugador1 = $games[0]['id_jugador1'];
        $jugador2 = $games[0]['id_jugador2'];
        $wins1 = 0;
        $wins2 = 0;
        $chars1 = array();
        $chars2 = array();
        $listaGames = array();

        foreach ($games as $game) 
        {
            if ($game['ganador'] == $jugador1) 
            {
                $wins1++;
                $lado = "p1";
            }
            else 
            {
                $wins2++;
                $lado = "p2";
            }

            $chars1[] = $game['id_personaje1'];
            $chars2[] = $game['id_personaje2'];

            /* Formato simple p1-3-4 para el data-games (sin JSON ni emojis) */
            $listaGames[] = $lado."-".$game['id_personaje1']."-".$game['id_personaje2'];
        }

        if ($wins1 > $wins2) 
        {
            $ganador = $jugador1;
            $perdedor = $jugador2;
        }
        else 
        {
            $ganador = $jugador2;
            $perdedor = $jugador1;
        }

        return array(
            "reportado" => true,
            "id_jugador1" => $jugador1,
            "id_jugador2" => $jugador2,
            "wins1" => $wins1,
            "wins2" => $wins2,
            "ganador" => $ganador,
            "perdedor" => $perdedor,
            "icono1" => $this->ctrPersonajeMasUsado($chars1),
            "icono2" => $this->ctrPersonajeMasUsado($chars2),
            "games_attr" => implode("|", $listaGames)
        );
    }

    /* ============================================================
       RECORD DE SETS HASTA ESTE ENFRENTAMIENTO
       No es el total al acabar el torneo: solo sets que este
       jugador ya habia jugado cuando se reporto este (incluido).
       Primer set = 1-0 / 0-1; el siguiente suma encima de ese.
       ============================================================ */
    public function ctrSacarRecordSets($idJugador, $idTorneo, $ronda, $pools)
    {
        $clave = $idJugador."-".$idTorneo."-".$pools."-".$ronda;

        if (isset($this->cacheRecordSets[$clave])) 
        {
            return $this->cacheRecordSets[$clave];
        }

        /* Games del jugador: los cacheo porque el cuadro pregunta muchos sets */
        $claveGames = $idJugador."-".$idTorneo;
        if (!isset($this->cacheGamesJugador[$claveGames])) 
        {
            $this->cacheGamesJugador[$claveGames] = PartidasModel::mdlSacarGamesJugadorTorneo("partidas", $idJugador, $idTorneo);
        }
        $games = $this->cacheGamesJugador[$claveGames];

        /* Agrupo games por set y guardo el id mas bajo (cuando se reporto) */
        $sets = array();
        foreach ($games as $game) 
        {
            $grupo = $game['pools']."|".$game['ronda'];

            if (!isset($sets[$grupo])) 
            {
                $sets[$grupo] = array(
                    "ganados" => 0,
                    "perdidos" => 0,
                    "orden" => (int) $game['id']
                );
            }

            if ((int) $game['id'] < $sets[$grupo]['orden']) 
            {
                $sets[$grupo]['orden'] = (int) $game['id'];
            }

            if ($game['ganador'] == $idJugador) 
            {
                $sets[$grupo]['ganados']++;
            }
            else 
            {
                $sets[$grupo]['perdidos']++;
            }
        }

        /* Tope: este enfrentamiento. Lo que se reporto despues no cuenta */
        $grupoActual = ((int) $pools)."|".$ronda;
        $tope = isset($sets[$grupoActual]) ? $sets[$grupoActual]['orden'] : 0;

        $setsGanados = 0;
        $setsPerdidos = 0;
        foreach ($sets as $set) 
        {
            if ($tope > 0 && $set['orden'] > $tope) 
            {
                continue;
            }

            if ($set['ganados'] > $set['perdidos']) 
            {
                $setsGanados++;
            }
            elseif ($set['ganados'] < $set['perdidos']) 
            {
                $setsPerdidos++;
            }
        }

        $texto = $setsGanados." - ".$setsPerdidos;
        $this->cacheRecordSets[$clave] = $texto;

        return $texto;
    }

    /* ============================================================
       CARGAR UN SLOT PARA AVANZAR EN EL CUADRO
       Si el set origen ya está reportado, saco ganador o perdedor
       (según $campo) con nombre y seed. Si no, el slot queda vacío
       y la caja enseña el texto de espera.
       ============================================================ */
    public function ctrCargarSlot($resumen, $campo, $usuario, $torneo, $idTorneo)
    {
        $slot = array("id" => "", "nombre" => "", "seed" => "");

        if (!empty($resumen['reportado']) && !empty($resumen[$campo])) 
        {
            $slot['id'] = $resumen[$campo];
            $jugador = $usuario->ctrSacarUsuario($slot['id']);
            $seed = $torneo->ctrSacarSeedDelJugador($slot['id'], $idTorneo);
            $slot['nombre'] = $jugador['usuario'];
            $slot['seed'] = $seed['seed'];
        }

        return $slot;
    }

    /* ============================================================
       PERSONAJE A PRESELECCIONAR EN EL SIGUIENTE REPORTE
       Cojo el último enfrentamiento reportado de este jugador
       (no el último game suelto). En ese set uso el personaje
       más jugado; si hay empate, el del primer game.
       ============================================================ */
    public function ctrSacarUltimoPersonaje($idJugador, $idTorneo)
    {
        $tabla = "partidas";
        $ultimoGame = PartidasModel::mdlSacarUltimoGameJugador($tabla, $idJugador, $idTorneo);

        if (!$ultimoGame) 
        {
            return "";
        }

        /* Todo el set de ese último combate (misma ronda + pool) */
        $datosSet = array(
            "id_Torneo" => $idTorneo,
            "ronda" => $ultimoGame['ronda'],
            "pools" => $ultimoGame['pools']
        );
        $games = PartidasModel::mdlSacarPartidasConGames($tabla, $datosSet);

        if (!$games) 
        {
            return "";
        }

        $listaIds = array();
        foreach ($games as $game) 
        {
            if ($game['id_jugador1'] == $idJugador) 
            {
                $listaIds[] = $game['id_personaje1'];
            }
            else 
            {
                $listaIds[] = $game['id_personaje2'];
            }
        }

        return $this->ctrIdPersonajeMasUsado($listaIds);
    }

    /* ============================================================
       REPORTAR EL ENFRENTAMIENTO
       Lee el POST del formulario (quién ganó cada game y con qué
       personaje), calcula puntos, borra el preliminar e inserta
       solo los games que se han jugado.
       ============================================================ */
    public function ctrReportar($jugador1, $jugador2, $idTorneo, $ronda, $pools)
    {
        $tabla = "partidas";

        $partida = array("jugador1" => $jugador1,
                        "jugador2" => $jugador2,
                        "id_Torneo" => $idTorneo,
                        "pools" => (int) $pools,
                        "ronda" => $ronda);

        /* Si este set ya tiene games, no vuelvo a reportar */
        $yaReportado = PartidasModel::mdlSacarPartidasConGames($tabla, $partida);
        if ($yaReportado) 
        {
            return "ya reportado";
        }

        if (isset($_POST['game1']))
        {
            $seed1 = isset($_POST['seed1']) ? (int) $_POST['seed1'] : 0;
            $seed2 = isset($_POST['seed2']) ? (int) $_POST['seed2'] : 0;

            $datos = array();

            /* Recorro hasta 5 games; los deshabilitados del JS no llegan por POST */
            for ($i = 1; $i <= 5; $i++) 
            {
                if (!isset($_POST['game'.$i])) 
                {
                    break;
                }

                $datos['game'.$i] = $_POST['game'.$i];
                $datos['game'.$i.'_p1_char'] = $_POST['game'.$i.'_p1_char'];
                $datos['game'.$i.'_p2_char'] = $_POST['game'.$i.'_p2_char'];

                /* Quién ha ganado este game */
                if ($_POST['game'.$i] == "p1") 
                {
                    $idGanadorGame = $jugador1;
                }
                else 
                {
                    $idGanadorGame = $jugador2;
                }

                /* Puntos de sorpresa para este game */
                $puntos = $this->ctrCalcularPuntosGame($idGanadorGame, $jugador1, $jugador2, $seed1, $seed2);
                $idPerdedorGame = ($idGanadorGame == $jugador1) ? $jugador2 : $jugador1;
                $torneoNpc = new TorneoController();
                $ganaNpc = $torneoNpc->ctrEsNpc($idGanadorGame);

                /* El NPC no es jugador de verdad: no suma puntos */
                if ($ganaNpc) 
                {
                    $puntos = 0;
                    /* El humano que pierde contra el NPC pierde 20-40 de sorpresa */
                    if (!$torneoNpc->ctrEsNpc($idPerdedorGame)) 
                    {
                        $penalizacion = rand(20, 40);
                        UsuariosModel::mdlRestarPuntuacion($idPerdedorGame, $penalizacion);
                    }
                }
                else 
                {
                    UsuariosModel::mdlSumarPuntuacion($idGanadorGame, $puntos);
                }

                $datos['puntos_game'.$i] = $puntos;
            }

            $respuesta = PartidasModel::mdlIngresarPartida($tabla, $datos, $partida);

            /* Grand Final (H) o el reset (X): cierro el torneo o creo el X */
            if ($respuesta && (int) $pools === 0) 
            {
                $this->ctrResolverFinalTorneo($idTorneo, $ronda, $jugador1, $jugador2);
            }

            return $respuesta;
        }
        else 
        {
            return "no entra";
        }

    }

    /* ============================================================
       GRAND FINAL Y RESET
       - Si gana el de G en H: el torneo termina (estado = true).
       - Si gana el de W en H: se crea el set X (Grand final reset).
       - Si se reporta X: el ganador es campeon y se cierra el torneo.
       ============================================================ */
    public function ctrResolverFinalTorneo($idTorneo, $ronda, $jugador1, $jugador2)
    {
        if ($ronda == "X") 
        {
            TorneoModel::mdlCerrarTorneo("torneo", $idTorneo);
            return;
        }

        if ($ronda != "H") 
        {
            return;
        }

        $resumenH = $this->ctrSacarResumenSet($idTorneo, "H", 0);
        $resumenG = $this->ctrSacarResumenSet($idTorneo, "G", 0);

        if (empty($resumenH['reportado']) || empty($resumenG['ganador'])) 
        {
            return;
        }

        /* El de winners (G) gano la Grand Final: no hace falta reset */
        if ($resumenH['ganador'] == $resumenG['ganador']) 
        {
            TorneoModel::mdlCerrarTorneo("torneo", $idTorneo);
            return;
        }

        /* Gano el que venia de losers (W): mismo vs mismo en X */
        $this->ctrCrearPartidaPreliminar($jugador1, $jugador2, $idTorneo, "X", 0);
    }

    /* ============================================================
       CLASIFICADOS AL TOP 16
       Torneo 32: de cada pool salen E, F, I, J.
       Torneo 64: de cada pool salen M, N, AB, AC.
       El resumen solo enseña el bloque cuando estan los 16.
       ============================================================ */
    public function ctrSacarJugadoresTop16($idTorneo, $torneoCtrl)
    {
        $lista = array();
        $datosTorneo = $torneoCtrl->ctrSacarTorneo($idTorneo);
        $rondasSalida = array("E", "F", "I", "J");
        if (!empty($datosTorneo['max_entrant']) && (int) $datosTorneo['max_entrant'] == 64) 
        {
            $rondasSalida = array("M", "N", "AB", "AC");
        }

        for ($pool = 1; $pool <= 4; $pool++) 
        {
            foreach ($rondasSalida as $ronda) 
            {
                $resumen = $this->ctrSacarResumenSet($idTorneo, $ronda, $pool);

                if (empty($resumen['reportado']) || empty($resumen['ganador'])) 
                {
                    continue;
                }

                $seed = $torneoCtrl->ctrSacarSeedDelJugador($resumen['ganador'], $idTorneo);
                $lista[] = array(
                    "id" => $resumen['ganador'],
                    "seed" => isset($seed['seed']) ? (int) $seed['seed'] : 999
                );
            }
        }

        /* Seed mas baja = mejor (mas puntuacion al inscribir) */
        usort($lista, function($a, $b) {
            if ($a['seed'] == $b['seed']) 
            {
                return 0;
            }
            return ($a['seed'] < $b['seed']) ? -1 : 1;
        });

        return $lista;
    }

    /* ============================================================
       PESO DE UNA RONDA PARA EL RANKING
       Cuanto mas tarde te eliminan, mas alto el numero.
       pools = 0 es el Top 16; el resto son las pools.
       ============================================================ */
    private function ctrPesoRondaStanding($ronda, $pools, $maxEntrant)
    {
        $letra = strtoupper((string) $ronda);
        $pools = (int) $pools;

        if ($pools == 0) 
        {
            $mapa = array(
                "J" => 40, "K" => 40, "L" => 40, "M" => 40,
                "N" => 45, "O" => 45, "P" => 45, "Q" => 45,
                "A" => 50, "B" => 50, "C" => 50, "D" => 50,
                "R" => 55, "S" => 55,
                "T" => 60, "U" => 60,
                "E" => 65, "F" => 65,
                "V" => 70,
                "G" => 75,
                "W" => 85,
                "H" => 95,
                "X" => 100
            );
            return isset($mapa[$letra]) ? $mapa[$letra] : 35;
        }

        if ((int) $maxEntrant == 64) 
        {
            $mapa = array(
                "A" => 10, "B" => 10, "C" => 10, "D" => 10,
                "E" => 10, "F" => 10, "G" => 10, "H" => 10,
                "R" => 12, "S" => 12, "T" => 12, "U" => 12,
                "V" => 14, "W" => 14, "X" => 14, "Y" => 14,
                "I" => 18, "J" => 18, "K" => 18, "L" => 18,
                "Z" => 20, "AA" => 20,
                "M" => 28, "N" => 28, "AB" => 28, "AC" => 28
            );
            return isset($mapa[$letra]) ? $mapa[$letra] : 8;
        }

        $mapa = array(
            "A" => 10, "B" => 10,
            "G" => 12, "H" => 16,
            "C" => 18, "D" => 18,
            "E" => 28, "F" => 28, "I" => 28, "J" => 28
        );
        return isset($mapa[$letra]) ? $mapa[$letra] : 8;
    }

    /* ============================================================
       STANDING DE PARTICIPANTES
       Ranking = resultado del cuadro (mas lejos = mejor puesto).
       "pierde con" = cada rival que te gano un set, en orden.
       Si el mismo te gano dos veces, el nick sale dos veces.
       Los NPC no salen en la lista, pero su nick si en "pierde con".
       ============================================================ */
    public function ctrSacarStandingParticipantes($idTorneo, $inscritos)
    {
        $datosTorneo = TorneoModel::mdlSacarTorneo("torneo", "id_torneo", $idTorneo);
        $maxEntrant = (!empty($datosTorneo['max_entrant'])) ? (int) $datosTorneo['max_entrant'] : 32;

        $nicks = array();
        $standing = array();

        foreach ($inscritos as $fila) 
        {
            $id = (int) $fila['id_jugador'];
            $nicks[$id] = $fila['usuario'];
            $standing[$id] = array(
                "id" => $id,
                "usuario" => $fila['usuario'],
                "img" => isset($fila['img']) ? $fila['img'] : "default.png",
                "seed" => (int) $fila['seed'],
                /* Lo arrastro; Participantes ordena por esta fecha, Posicionamiento no */
                "fecha_inscripcion" => isset($fila['fecha_inscripcion']) ? $fila['fecha_inscripcion'] : "",
                "wins" => 0,
                "losses" => 0,
                "lostTo" => array(),
                "pesoMax" => 0,
                "pesoElim" => 0,
                "campeon" => 0
            );
        }

        $games = PartidasModel::mdlSacarGamesTorneo("partidas", $idTorneo);
        $sets = array();

        foreach ($games as $game) 
        {
            $grupo = $game['pools']."|".$game['ronda'];

            if (!isset($sets[$grupo])) 
            {
                $sets[$grupo] = array(
                    "j1" => (int) $game['id_jugador1'],
                    "j2" => (int) $game['id_jugador2'],
                    "g1" => 0,
                    "g2" => 0,
                    "orden" => (int) $game['id'],
                    "ronda" => $game['ronda'],
                    "pools" => (int) $game['pools']
                );
            }

            if ((int) $game['ganador'] == $sets[$grupo]['j1']) 
            {
                $sets[$grupo]['g1']++;
            }
            elseif ((int) $game['ganador'] == $sets[$grupo]['j2']) 
            {
                $sets[$grupo]['g2']++;
            }
        }

        /* Orden cronologico: primero las derrotas viejas, luego las nuevas */
        usort($sets, function($a, $b) {
            return ($a['orden'] < $b['orden']) ? -1 : 1;
        });

        foreach ($sets as $set) 
        {
            if ($set['g1'] == $set['g2']) 
            {
                continue;
            }

            $ganador = ($set['g1'] > $set['g2']) ? $set['j1'] : $set['j2'];
            $perdedor = ($ganador == $set['j1']) ? $set['j2'] : $set['j1'];
            $peso = $this->ctrPesoRondaStanding($set['ronda'], $set['pools'], $maxEntrant);

            if (isset($standing[$ganador])) 
            {
                $standing[$ganador]['wins']++;
                if ($peso > $standing[$ganador]['pesoMax']) 
                {
                    $standing[$ganador]['pesoMax'] = $peso;
                }
            }

            if (isset($standing[$perdedor])) 
            {
                $standing[$perdedor]['losses']++;
                $standing[$perdedor]['lostTo'][] = isset($nicks[$ganador]) ? $nicks[$ganador] : "";
                if ($peso > $standing[$perdedor]['pesoElim']) 
                {
                    $standing[$perdedor]['pesoElim'] = $peso;
                }
            }
        }

        /* Campeon: gano el reset X, o gano H si no hubo reset */
        foreach ($sets as $set) 
        {
            if ((int) $set['pools'] != 0) 
            {
                continue;
            }
            $letra = strtoupper((string) $set['ronda']);
            if ($letra != "H" && $letra != "X") 
            {
                continue;
            }
            if ($set['g1'] == $set['g2']) 
            {
                continue;
            }
            $ganador = ($set['g1'] > $set['g2']) ? $set['j1'] : $set['j2'];
            if (isset($standing[$ganador]) && $letra == "X") 
            {
                $standing[$ganador]['campeon'] = 1;
            }
            if (isset($standing[$ganador]) && $letra == "H") 
            {
                $standing[$ganador]['campeon'] = 1;
            }
        }

        /* Si existe X cerrado, el campeon es solo el de X (no el de H) */
        foreach ($sets as $set) 
        {
            if ((int) $set['pools'] == 0 && strtoupper((string) $set['ronda']) == "X" && $set['g1'] != $set['g2']) 
            {
                foreach ($standing as $id => $fila) 
                {
                    $standing[$id]['campeon'] = 0;
                }
                $ganador = ($set['g1'] > $set['g2']) ? $set['j1'] : $set['j2'];
                if (isset($standing[$ganador])) 
                {
                    $standing[$ganador]['campeon'] = 1;
                }
            }
        }

        $lista = array_values($standing);
        usort($lista, function($a, $b) {
            if ($a['campeon'] != $b['campeon']) 
            {
                return ($a['campeon'] > $b['campeon']) ? -1 : 1;
            }

            /* Quien sigue vivo (menos de 2 derrotas) va delante */
            $vivoA = ($a['losses'] < 2) ? 1 : 0;
            $vivoB = ($b['losses'] < 2) ? 1 : 0;
            if ($vivoA != $vivoB) 
            {
                return ($vivoA > $vivoB) ? -1 : 1;
            }

            if ($vivoA == 1) 
            {
                if ($a['pesoMax'] != $b['pesoMax']) 
                {
                    return ($a['pesoMax'] > $b['pesoMax']) ? -1 : 1;
                }
                if ($a['wins'] != $b['wins']) 
                {
                    return ($a['wins'] > $b['wins']) ? -1 : 1;
                }
            }
            else 
            {
                /* Eliminado: mas tarde en el cuadro = mejor puesto */
                if ($a['pesoElim'] != $b['pesoElim']) 
                {
                    return ($a['pesoElim'] > $b['pesoElim']) ? -1 : 1;
                }
                if ($a['wins'] != $b['wins']) 
                {
                    return ($a['wins'] > $b['wins']) ? -1 : 1;
                }
            }

            return ($a['seed'] < $b['seed']) ? -1 : 1;
        });

        /* ============================================================
           QUITAR NPC DEL LISTADO
           Los NPC siguen en las partidas: si un humano pierde un set
           contra uno, "pierde con" enseña ese NPC. Aqui no pintamos
           la fila del NPC en Participantes ni en Posicionamiento.
           ============================================================ */
        $sinNpc = array();
        foreach ($lista as $fila) 
        {
            if (strpos($fila['usuario'], "NPC") === 0) 
            {
                continue;
            }
            $sinNpc[] = $fila;
        }

        return $sinNpc;
    }

}
