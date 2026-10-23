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

    public function ctrSacarPools($id)
    {
        $tabla = "torneo_jugador";
        $campo = "id_torneos";

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
            foreach ($registrosSeed as $key => $seed) 
            {
                if ($cont == 16) {
                    break;
                }
                $SegundoSeed = $NumeroMagico - $seed['seed'];
                //Busco id jugador del Segundo Seed
                $jugador = TorneoModel::mdlSacarRegistroEspecifico("torneo_jugador","seed",$SegundoSeed);

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

}