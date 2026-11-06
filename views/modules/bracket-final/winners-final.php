<div class="bp-final-w mb-14">
    <div class="bp-title bp-c2 bp-r1">Winners Quarter-Final</div>
    <div class="bp-title bp-c3 bp-r1">Winners Semi-Final</div>
    <div class="bp-title bp-c4 bp-r1">Winners Final</div>
    <div class="bp-title bp-c5 bp-r1">Grand Final</div>
    <?php
        /* Titulo del reset: solo si gano el de losers (W) en H */
        if (!empty($hayResetGrandFinal)) 
        {
    ?>
    <div class="bp-title bp-c6 bp-r1">Grand final reset</div>
    <?php
        }
    ?>

    <?php
        /* ============================================================
           TOP 16 WINNERS
           Según la imagen de origen:
           A = dos winners de pool A1 (ganador de E y de F)
           B = dos winners de pool B2
           C = dos winners de pool A2
           D = dos winners de pool B1
           E = winner of A vs winner of B
           F = winner of C vs winner of D
           G = winner of E vs winner of F
           H = winner of G vs winner of W
           Pools en DB: 1=A1, 2=A2, 3=B1, 4=B2
           ============================================================ */

        $slotVacio = array("id" => "", "nombre" => "", "seed" => "");

        /* ---------- A : Bracket A1 vs Bracket A1 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[1]['E'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[1]['F'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "A";
        $setCol = 2;
        $setRow = 2;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "Bracket A1: Winners";
        $setEspera2 = "Bracket A1: Winners";
        $setFeed1 = "Bracket A1";
        $setFeed2 = "Bracket A1";
        include("pintar-set-final.php");

        /* ---------- B : Bracket B2 vs Bracket B2 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[4]['E'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[4]['F'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "B";
        $setCol = 2;
        $setRow = 4;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "Bracket B2: Winners";
        $setEspera2 = "Bracket B2: Winners";
        $setFeed1 = "Bracket B2";
        $setFeed2 = "Bracket B2";
        include("pintar-set-final.php");

        /* ---------- C : Bracket A2 vs Bracket A2 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[2]['E'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[2]['F'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "C";
        $setCol = 2;
        $setRow = 6;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "Bracket A2: Winners";
        $setEspera2 = "Bracket A2: Winners";
        $setFeed1 = "Bracket A2";
        $setFeed2 = "Bracket A2";
        include("pintar-set-final.php");

        /* ---------- D : Bracket B1 vs Bracket B1 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[3]['E'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[3]['F'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "D";
        $setCol = 2;
        $setRow = 8;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "Bracket B1: Winners";
        $setEspera2 = "Bracket B1: Winners";
        $setFeed1 = "Bracket B1";
        $setFeed2 = "Bracket B1";
        include("pintar-set-final.php");

        /* ---------- E : winner of A vs winner of B ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['A'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['B'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "E";
        $setCol = 3;
        $setRow = 2;
        $setSpan = 4;
        $setRonda = "Winners Semi-Final";
        $setEspera1 = "winner of A";
        $setEspera2 = "winner of B";
        include("pintar-set-final.php");

        /* ---------- F : winner of C vs winner of D ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['C'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['D'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "F";
        $setCol = 3;
        $setRow = 6;
        $setSpan = 4;
        $setRonda = "Winners Semi-Final";
        $setEspera1 = "winner of C";
        $setEspera2 = "winner of D";
        include("pintar-set-final.php");

        /* ---------- G : winner of E vs winner of F ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['E'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['F'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "G";
        $setCol = 4;
        $setRow = 2;
        $setSpan = 8;
        $setRonda = "Winners Final";
        $setEspera1 = "winner of E";
        $setEspera2 = "winner of F";
        include("pintar-set-final.php");

        /* ---------- H : winner of G vs winner of W ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['G'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['W'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "H";
        $setCol = 5;
        $setRow = 2;
        $setSpan = 8;
        $setRonda = "Grand Final";
        $setEspera1 = "winner of G";
        $setEspera2 = "winner of W";
        include("pintar-set-final.php");

        /* ---------- X : mismos jugadores de H si gano el de W ---------- */
        if (!empty($hayResetGrandFinal)) 
        {
            $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['G'], "ganador", $usuario, $torneo, $idTorneoFinal);
            $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['W'], "ganador", $usuario, $torneo, $idTorneoFinal);
            $setLetra = "X";
            $setCol = 6;
            $setRow = 2;
            $setSpan = 8;
            $setRonda = "Grand final reset";
            $setEspera1 = "winner of G";
            $setEspera2 = "winner of W";
            include("pintar-set-final.php");
        }
    ?>
</div>
