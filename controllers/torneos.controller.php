<?php
  
class TorneoController{

    public function ctrMostrarTorneoRecientesLimit($limit)
    {
        $tabla = "torneo";
        $respuesta = TorneoModel::mdlMostrarTorneoRecientesLimit($tabla, $limit);

        return $respuesta;
    }

    public function ctrSacarTorneo($id)
    {
        $tabla = "torneo";
        $campo = "id_torneo";
        $respuesta = TorneoModel::mdlSacarTorneo($tabla,$campo,$id);
        return $respuesta;
    }

    public function ctrSacarTotalAsistentes($id)
    {
        $tabla = "torneo_jugador";
        $campo = "id_torneos";
        $total = TorneoModel::Total_registros($tabla, $campo, $id);
        return $total;
    }

    //Creo mi propio array orientado a objetos
    public $MiSeed = [];

    public function ctrSacarSeeding($id)
    {
        $tabla = "torneo_jugador";
        $campo = "id_torneos";
        $this->MiSeed = array();

        //Saco los datos del torneo especifico
        $torneo = TorneoModel::mdlSacarTorneo("torneo","id_torneo",$id);
        //Saco Todos los jugadores y seed del torneo especifico registrado en el id del torneo
        $registrosSeed = TorneoModel::mdlSacarRegistrosDelTorneoEspecifico($tabla,$campo,$id); 
        //Saco el total de asistentes segun los jugadores registrados en el id del torneo
        $totalAsistentes = TorneoModel::Total_registros($tabla, $campo, $id);


        if (count($registrosSeed) == $torneo['max_entrant']) 
        {
            // Aqui lo que voy a hacer es guardar los enfrentamientos de forma todos sumen lo mismo que en este caso si son 32
            // Serian 33 por que por ejemplo el seed 1 iria contra el 32, el 2 iria contra el 31
            $NumeroMagico = $totalAsistentes + 1;
            $cont = 0;
            $numeromaximotorneo = (int) $torneo['max_entrant'];
            $MaxCont = count($registrosSeed) / 2;
            foreach ($registrosSeed as $key => $seed) 
            {
                if ($cont == $MaxCont) {
                    break;
                }
                $SegundoSeed = $NumeroMagico - $seed['seed'];
                /* El rival se busca EN ESTE torneo (no en otro con la misma seed) */
                $jugador = TorneoModel::mdlSacarSeedTorneo($tabla, $campo, $SegundoSeed, $id);

                if ($seed['seed'] > $SegundoSeed) 
                {
                    //Añado los datos de los seeds
                    $this->MiSeed[] = 
                    ["idJugadorSeedAlto" => $seed['id_jugador'],
                    "SeedAlto" => $seed['seed'], 
                    "idJugadorSeedBajo" => $jugador['id_jugador'], 
                    "SeedBajo" => $jugador['seed']];
                }
                else 
                {
                    //Añado los datos de los seeds
                    $this->MiSeed[] = 
                    ["idJugadorSeedAlto" => $jugador['id_jugador'],
                    "SeedAlto" => $jugador['seed'], 
                    "idJugadorSeedBajo" => $seed['id_jugador'], 
                    "SeedBajo" => $seed['seed']];
                }

                $cont++;
            }
        }
        else
        {
            if (count($registrosSeed) % 2 == 0) 
            {
                $respuesta = "esta bien pero no tanto";
            }
            else 
            {
                $respuesta = "estamos jodidos";
            }
        }

        return $this->MiSeed;
    }

    public function ctrSacarSeedDelTorneo($seed, $id)
    {
        $tabla = "torneo_jugador";
        $campo = "id_torneos";
        $respuesta = TorneoModel::mdlSacarSeedTorneo($tabla,$campo,$seed,$id);
        return $respuesta;
    }

    /* Saco la fila de seeding de un jugador concreto en este torneo */
    public function ctrSacarSeedDelJugador($idJugador, $id)
    {
        $tabla = "torneo_jugador";
        $respuesta = TorneoModel::mdlSacarSeedJugador($tabla, $idJugador, $id);
        return $respuesta;
    }

    /* ============================================================
       MARCAR EL TORNEO COMO FINALIZADO
       estado true = ya hay campeon y no se siguen jugando sets.
       ============================================================ */
    public function ctrCerrarTorneo($idTorneo)
    {
        return TorneoModel::mdlCerrarTorneo("torneo", $idTorneo);
    }

    /* ============================================================
       LISTA DE INSCRITOS (seed, nick y puntos)
       Sirve para Participantes y Posicionamiento.
       ============================================================ */
    public function ctrSacarInscritosTorneo($idTorneo)
    {
        return TorneoModel::mdlSacarInscritosConPuntos($idTorneo);
    }

    /* ============================================================
       ¿ESTE ID ES UN NPC?
       Los NPC se llaman NPC1, NPC2...
       ============================================================ */
    public function ctrEsNpc($idJugador)
    {
        $jugador = UsuariosModel::mdlSacarUsu("jugador", $idJugador);
        if (!$jugador || empty($jugador['usuario'])) 
        {
            return false;
        }

        return (strpos($jugador['usuario'], "NPC") === 0);
    }

    /* ============================================================
       RELLENAR PLAZAS VACIAS CON NPC SI EL TORNEO YA EMPEZO
       Si faltan inscritos respecto a max_entrant, meto NPC1..N.
       Luego rehago el seed: mas puntos = seed mas baja.
       ============================================================ */
    public function ctrRellenarConNpc($idTorneo)
    {
        $torneo = $this->ctrSacarTorneo($idTorneo);
        if (!$torneo) 
        {
            return;
        }

        $fechaActual = date("d/m/Y");
        $fechaInicio = date("d/m/Y", strtotime($torneo['fecha_inicio']));
        if ($fechaInicio > $fechaActual || !empty($torneo['estado'])) 
        {
            return;
        }

        $max = (int) $torneo['max_entrant'];
        $inscritos = TorneoModel::mdlSacarRegistrosDelTorneoEspecifico("torneo_jugador", "id_torneos", $idTorneo);
        $faltan = $max - count($inscritos);
        if ($faltan <= 0) 
        {
            return;
        }

        $n = 1;
        while ($faltan > 0) 
        {
            $nick = "NPC".$n;
            $filaNpc = UsuariosModel::mdlSacarUsuPorNick($nick);
            if (!$filaNpc) 
            {
                $idNpc = UsuariosModel::mdlCrearNpc($nick);
            }
            else 
            {
                $idNpc = $filaNpc['id'];
            }

            $yaEsta = TorneoModel::mdlSacarSeedJugador("torneo_jugador", $idNpc, $idTorneo);
            if ($yaEsta) 
            {
                $n++;
                continue;
            }

            /* Seed temporal; luego se reordena por puntos */
            TorneoModel::mdlInscribirJugador($idTorneo, $idNpc, $max);
            $faltan--;
            $n++;
        }

        /* Seed 1 = mas puntuacion (los NPC a 0 se van al final) */
        $conPuntos = TorneoModel::mdlSacarInscritosConPuntos($idTorneo);
        usort($conPuntos, function($a, $b) {
            if ((int) $a['pts'] == (int) $b['pts']) 
            {
                return ((int) $a['id_jugador'] < (int) $b['id_jugador']) ? -1 : 1;
            }
            return ((int) $a['pts'] > (int) $b['pts']) ? -1 : 1;
        });

        $seed = 1;
        foreach ($conPuntos as $fila) 
        {
            TorneoModel::mdlActualizarSeed($idTorneo, $fila['id_jugador'], $seed);
            $seed++;
        }
    }

}