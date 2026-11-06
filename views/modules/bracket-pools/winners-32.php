<div class="bp-w mb-14">
    <div class="bp-title col-start-1 row-start-1">Winners Quarter-Final</div>
    <div class="bp-title col-start-2 row-start-1">Winners Semi-Final</div>

    <?php

        $u = 0;
        $NumeroSeed = (int) $_GET['pool'];

        // Aqui hago un bucle el cual me permite guardar todo el abecedario y si pasa la Z incluso me hace AA AB etc
        foreach (range('A', 'Z') as $letra1) {
            foreach (range('A', 'Z') as $letra2) {
                $abecedario[] = $letra1 . $letra2;
            }
        }
        $recorrerbracket = 2;
        foreach ($seeds as $key => $pool) 
        {   
            // Toda esta zona es para sacar los usuarios de rondas preliminares
            $enfrentamiento = 33;
            if ($u == 4) 
            {
                break;
            }
            $enfrentamiento = $enfrentamiento - $NumeroSeed;

            // Aqui busco mediante el numero de seed y el id del torneo el jugador especifico
            $seedBajo = $torneo->ctrSacarSeedDelTorneo($NumeroSeed,$_GET['id']);
            $seedAlto = $torneo->ctrSacarSeedDelTorneo($enfrentamiento,$_GET['id']);

            // Y luego aqui saco los datos del jugador
            $jugadorBueno = $usuario->ctrSacarUsuario($seedBajo['id_jugador']);
            $jugadorMalo = $usuario->ctrSacarUsuario($seedAlto['id_jugador']);

            //Ahora voy a guardar los datos preliminares de las partidas base
            $partida = $eliminatoria->ctrCrearPartidaPreliminar($seedBajo['id_jugador'], $seedAlto['id_jugador'], $_GET['id'], $abecedario[$u], $_GET['pool']); 

            switch ($u) 
            {
                case 0:
                    $NumeroSeed = $NumeroSeed + 12;
                break;
                case 1:
                    $NumeroSeed = $NumeroSeed - 8;
                break;
                case 2:
                    $NumeroSeed = $NumeroSeed + 4;
                break;
            } 

            /* Resumen del set: si ya hay games, la caja cambia de diseño */
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($_GET['id'], $abecedario[$u], $_GET['pool']);

            /* WINNERS QUARTER FINAL */
            $cajaLetra = $abecedario[$u];
            $cajaCol = 1;
            $cajaRow = $recorrerbracket;
            $cajaSpan = 2;
            $cajaRondaNombre = "Winners Quarter-Final";
            $cajaEspera1 = "";
            $cajaEspera2 = "";
            $cajaId1 = $seedBajo['id_jugador'];
            $cajaId2 = $seedAlto['id_jugador'];
            $cajaNom1 = $jugadorBueno['usuario'];
            $cajaNom2 = $jugadorMalo['usuario'];
            $cajaSeed1 = $seedBajo['seed'];
            $cajaSeed2 = $seedAlto['seed'];
            $cajaTop16 = false;
            include("caja-enfrentamiento.php");

            $u++;
            $recorrerbracket = $recorrerbracket + 2;
        }

        /* ============================================================
           WINNERS SEMI FINAL
           E = ganador de A vs ganador de B
           F = ganador de C vs ganador de D
           Solo se crea el preliminar cuando los dos orígenes
           ya están reportados.
           ============================================================ */
        $resumenA = $eliminatoria->ctrSacarResumenSet($_GET['id'], "A", $_GET['pool']);
        $resumenB = $eliminatoria->ctrSacarResumenSet($_GET['id'], "B", $_GET['pool']);
        $resumenC = $eliminatoria->ctrSacarResumenSet($_GET['id'], "C", $_GET['pool']);
        $resumenD = $eliminatoria->ctrSacarResumenSet($_GET['id'], "D", $_GET['pool']);

        $slot1 = $eliminatoria->ctrCargarSlot($resumenA, "ganador", $usuario, $torneo, $_GET['id']);
        $slot2 = $eliminatoria->ctrCargarSlot($resumenB, "ganador", $usuario, $torneo, $_GET['id']);
        $cajaId1 = $slot1['id'];
        $cajaNom1 = $slot1['nombre'];
        $cajaSeed1 = $slot1['seed'];
        $cajaId2 = $slot2['id'];
        $cajaNom2 = $slot2['nombre'];
        $cajaSeed2 = $slot2['seed'];
        $cajaResumen = array("reportado" => false);
        if ($cajaId1 && $cajaId2) 
        {
            $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $_GET['id'], "E", $_GET['pool']);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($_GET['id'], "E", $_GET['pool']);
        }

        $cajaLetra = "E";
        $cajaCol = 2;
        $cajaRow = 2;
        $cajaSpan = 4;
        $cajaRondaNombre = "Winners Semi-Final";
        $cajaEspera1 = "winner of A";
        $cajaEspera2 = "winner of B";
        $cajaTop16 = true;
        include("caja-enfrentamiento.php");

        $slot1 = $eliminatoria->ctrCargarSlot($resumenC, "ganador", $usuario, $torneo, $_GET['id']);
        $slot2 = $eliminatoria->ctrCargarSlot($resumenD, "ganador", $usuario, $torneo, $_GET['id']);
        $cajaId1 = $slot1['id'];
        $cajaNom1 = $slot1['nombre'];
        $cajaSeed1 = $slot1['seed'];
        $cajaId2 = $slot2['id'];
        $cajaNom2 = $slot2['nombre'];
        $cajaSeed2 = $slot2['seed'];
        $cajaResumen = array("reportado" => false);
        if ($cajaId1 && $cajaId2) 
        {
            $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $_GET['id'], "F", $_GET['pool']);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($_GET['id'], "F", $_GET['pool']);
        }

        $cajaLetra = "F";
        $cajaCol = 2;
        $cajaRow = 6;
        $cajaSpan = 4;
        $cajaRondaNombre = "Winners Semi-Final";
        $cajaEspera1 = "winner of C";
        $cajaEspera2 = "winner of D";
        $cajaTop16 = true;
        include("caja-enfrentamiento.php");
    ?>
</div>

<!-- MODAL CON LOS RESULTADOS YA HECHOS -->

<?php
    include("modal-resultados.php");
?>

<!-- MODAL CON LOS REPORTAMOS LOS GAMES -->

<?php
    include("modal-reportar.php");
?>

<script>
    const usuarioLogueado = <?php
        echo json_encode(UsuarioController::ctrComprobacionVersionModal());
    ?>;
</script>
