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

    ?>
    <!-- WINNERS QUARTER FINAL -->
    
    <?php
        //Voy a comprobar si el combate tiene resultado si lo tiene saldra el modal de resultados y sino el de reportar
        $reportar =  $eliminatoria->ctrBuscarSiEstasReportado($_GET['id'], $abecedario[$u], $_GET['pool']);
        if (is_null($reportar)) 
        {
    ?>
    <div class="bp-cell col-start-1 row-start-<?= $recorrerbracket ?> row-span-2"><span class="bp-tag"><?= $abecedario[$u] ?></span>
        <a href="#match-report-modal" class="js-match-modal bracket-match rounded-md border border-gray-200 bg-white shadow-sm"
            data-mode="report"
            data-round="Winners Quarter-Final"
            data-p1="<?= htmlspecialchars($jugadorBueno['usuario'], ENT_QUOTES, 'UTF-8') ?>"
            data-p2="<?= htmlspecialchars($jugadorMalo['usuario'], ENT_QUOTES, 'UTF-8') ?>"
            data-s1="3"
            data-s2="1">
    <?php
        }
        else 
        {
    ?>
    <div class="bp-cell col-start-1 row-start-<?= $recorrerbracket ?> row-span-2"><span class="bp-tag"><?= $abecedario[$u] ?></span>
        <a href="#match-modal" class="js-match-modal bracket-match rounded-md border border-gray-200 bg-white shadow-sm"
            data-mode="result"
            data-round="Winners Quarter-Final"
            data-p1="<?= htmlspecialchars($jugadorBueno['usuario'], ENT_QUOTES, 'UTF-8') ?>"
            data-p2="<?= htmlspecialchars($jugadorMalo['usuario'], ENT_QUOTES, 'UTF-8') ?>"
            data-s1="3"
            data-s2="1">
    <?php
        }
    ?>
            <div class="bp-row border-b border-gray-100">
                <span class="bp-seed"><?= $seedBajo['seed'] ?></span>
                <span class="bp-name font-semibold text-slate-800"><?= $jugadorBueno['usuario'] ?></span>
            </div>
            <div class="bp-row">
                <span class="bp-seed"><?= $seedAlto['seed'] ?></span>
                <span class="bp-name font-semibold text-slate-800"><?= $jugadorMalo['usuario'] ?></span>
            </div>
        </a>
    </div>
    <?php
            $u++;
            $recorrerbracket = $recorrerbracket + 2;
        }
    ?>

    <!-- WINNERS SEMI FINAL -->

    <div class="bp-cell col-start-2 row-start-2 row-span-4"><span class="bp-tag">E</span>
        <a href="#match-modal" class="js-match-modal bracket-match rounded-md border border-gray-200 bg-white shadow-sm"
            data-mode="result"
            data-round="Winners Semi-Final"
            data-p1="winner of A"
            data-p2="winner of B">
            <div class="bp-row border-b border-gray-100"><span class="bp-wait">winner of A</span></div>
            <div class="bp-row"><span class="bp-wait">winner of B</span></div>
        </a><span class="ml-2 w-8 shrink-0 border-t border-dashed border-gray-300"></span><a href="#"
            class="bp-top">Top 16</a>
    </div>
    <div class="bp-cell col-start-2 row-start-6 row-span-4"><span class="bp-tag">F</span>
        <a href="#match-report-modal" class="js-match-modal bracket-match rounded-md border border-gray-200 bg-white shadow-sm"
            data-mode="report"
            data-round="Winners Semi-Final"
            data-p1="winner of C"
            data-p2="winner of D">
            <div class="bp-row border-b border-gray-100"><span class="bp-wait">winner of C</span></div>
            <div class="bp-row"><span class="bp-wait">winner of D</span></div>
        </a><span class="ml-2 w-8 shrink-0 border-t border-dashed border-gray-300"></span><a href="#"
            class="bp-top">Top 16</a>
    </div>
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