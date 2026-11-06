<div class="bp-l">

    <div class="bp-title col-start-1 row-start-1">Losers Round 1</div>
    <div class="bp-title col-start-2 row-start-1">Losers Quarter-Final</div>

    <?php
        /* ============================================================
           LOSERS: avanzo a quien pierde en winners, aunque el rival
           del siguiente set todavía no esté. Así Szeth (winner of G)
           aparece en I en cuanto gana G, y el perdedor de F llega
           cuando F se reporte.
           G = perdedor de A vs perdedor de B
           H = perdedor de C vs perdedor de D
           I = perdedor de F vs ganador de G
           J = perdedor de E vs ganador de H
           ============================================================ */
        $idTorneoCaja = $_GET['id'];
        $poolCaja = $_GET['pool'];

        $resumenA = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "A", $poolCaja);
        $resumenB = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "B", $poolCaja);
        $resumenC = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "C", $poolCaja);
        $resumenD = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "D", $poolCaja);
        $resumenE = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "E", $poolCaja);
        $resumenF = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "F", $poolCaja);
        $resumenG = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "G", $poolCaja);
        $resumenH = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "H", $poolCaja);

        /* ---------- G ---------- */
        $slot1 = $eliminatoria->ctrCargarSlot($resumenA, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $slot2 = $eliminatoria->ctrCargarSlot($resumenB, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $cajaId1 = $slot1['id'];
        $cajaNom1 = $slot1['nombre'];
        $cajaSeed1 = $slot1['seed'];
        $cajaId2 = $slot2['id'];
        $cajaNom2 = $slot2['nombre'];
        $cajaSeed2 = $slot2['seed'];
        $cajaResumen = array("reportado" => false);
        if ($cajaId1 && $cajaId2) 
        {
            $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $idTorneoCaja, "G", $poolCaja);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "G", $poolCaja);
            $resumenG = $cajaResumen;
        }
        $cajaLetra = "G";
        $cajaCol = 1;
        $cajaRow = 2;
        $cajaSpan = 2;
        $cajaRondaNombre = "Losers Round 1";
        $cajaEspera1 = "loser of A";
        $cajaEspera2 = "loser of B";
        $cajaTop16 = false;
        include("caja-enfrentamiento.php");

        /* ---------- H ---------- */
        $slot1 = $eliminatoria->ctrCargarSlot($resumenC, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $slot2 = $eliminatoria->ctrCargarSlot($resumenD, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $cajaId1 = $slot1['id'];
        $cajaNom1 = $slot1['nombre'];
        $cajaSeed1 = $slot1['seed'];
        $cajaId2 = $slot2['id'];
        $cajaNom2 = $slot2['nombre'];
        $cajaSeed2 = $slot2['seed'];
        $cajaResumen = array("reportado" => false);
        if ($cajaId1 && $cajaId2) 
        {
            $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $idTorneoCaja, "H", $poolCaja);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "H", $poolCaja);
            $resumenH = $cajaResumen;
        }
        $cajaLetra = "H";
        $cajaCol = 1;
        $cajaRow = 5;
        $cajaSpan = 2;
        $cajaRondaNombre = "Losers Round 1";
        $cajaEspera1 = "loser of C";
        $cajaEspera2 = "loser of D";
        $cajaTop16 = false;
        include("caja-enfrentamiento.php");

        /* ---------- I : loser of F vs winner of G ---------- */
        $slot1 = $eliminatoria->ctrCargarSlot($resumenF, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $slot2 = $eliminatoria->ctrCargarSlot($resumenG, "ganador", $usuario, $torneo, $idTorneoCaja);
        $cajaId1 = $slot1['id'];
        $cajaNom1 = $slot1['nombre'];
        $cajaSeed1 = $slot1['seed'];
        $cajaId2 = $slot2['id'];
        $cajaNom2 = $slot2['nombre'];
        $cajaSeed2 = $slot2['seed'];
        $cajaResumen = array("reportado" => false);
        if ($cajaId1 && $cajaId2) 
        {
            $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $idTorneoCaja, "I", $poolCaja);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "I", $poolCaja);
        }
        $cajaLetra = "I";
        $cajaCol = 2;
        $cajaRow = 2;
        $cajaSpan = 2;
        $cajaRondaNombre = "Losers Quarter-Final";
        $cajaEspera1 = "loser of F";
        $cajaEspera2 = "winner of G";
        $cajaTop16 = true;
        include("caja-enfrentamiento.php");

        /* ---------- J : loser of E vs winner of H ---------- */
        $slot1 = $eliminatoria->ctrCargarSlot($resumenE, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $slot2 = $eliminatoria->ctrCargarSlot($resumenH, "ganador", $usuario, $torneo, $idTorneoCaja);
        $cajaId1 = $slot1['id'];
        $cajaNom1 = $slot1['nombre'];
        $cajaSeed1 = $slot1['seed'];
        $cajaId2 = $slot2['id'];
        $cajaNom2 = $slot2['nombre'];
        $cajaSeed2 = $slot2['seed'];
        $cajaResumen = array("reportado" => false);
        if ($cajaId1 && $cajaId2) 
        {
            $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $idTorneoCaja, "J", $poolCaja);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "J", $poolCaja);
        }
        $cajaLetra = "J";
        $cajaCol = 2;
        $cajaRow = 5;
        $cajaSpan = 2;
        $cajaRondaNombre = "Losers Quarter-Final";
        $cajaEspera1 = "loser of E";
        $cajaEspera2 = "winner of H";
        $cajaTop16 = true;
        include("caja-enfrentamiento.php");
    ?>
</div>
