<div class="bp-final-l">
    <div class="bp-title bp-c2 bp-r1">Losers Round 1</div>
    <div class="bp-title bp-c3 bp-r1">Losers Round 2</div>
    <div class="bp-title bp-c4 bp-r1">Losers Round 3</div>
    <div class="bp-title bp-c5 bp-r1">Losers Quarter-Final</div>
    <div class="bp-title bp-c6 bp-r1">Losers Semi-Final</div>
    <div class="bp-title bp-c7 bp-r1">Losers Final</div>

    <?php
        /* ============================================================
           TOP 16 LOSERS (según la imagen de origen)
           J = B2 loser I vs A2 loser I
           K = A1 loser I vs B1 loser I
           L = B1 loser J vs A1 loser J
           M = A2 loser J vs B2 loser J
           N = loser of D vs winner of J
           O = loser of C vs winner of K
           P = loser of B vs winner of L
           Q = loser of A vs winner of M
           R = winner of N vs winner of O
           S = winner of P vs winner of Q
           T = loser of E vs winner of R
           U = loser of F vs winner of S
           V = winner of T vs winner of U
           W = loser of G vs winner of V
           ============================================================ */

        /* ---------- J ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[4]['I'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[2]['I'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "J";
        $setCol = 2;
        $setRow = 2;
        $setSpan = 2;
        $setRonda = "Losers Round 1";
        $setEspera1 = "Bracket B2: Losers";
        $setEspera2 = "Bracket A2: Losers";
        $setFeed1 = "Bracket B2";
        $setFeed2 = "Bracket A2";
        include("pintar-set-final.php");

        /* ---------- K ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[1]['I'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[3]['I'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "K";
        $setCol = 2;
        $setRow = 4;
        $setSpan = 2;
        $setRonda = "Losers Round 1";
        $setEspera1 = "Bracket A1: Losers";
        $setEspera2 = "Bracket B1: Losers";
        $setFeed1 = "Bracket A1";
        $setFeed2 = "Bracket B1";
        include("pintar-set-final.php");

        /* ---------- L ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[3]['J'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[1]['J'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "L";
        $setCol = 2;
        $setRow = 6;
        $setSpan = 2;
        $setRonda = "Losers Round 1";
        $setEspera1 = "Bracket B1: Losers";
        $setEspera2 = "Bracket A1: Losers";
        $setFeed1 = "Bracket B1";
        $setFeed2 = "Bracket A1";
        include("pintar-set-final.php");

        /* ---------- M ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($poolRes[2]['J'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($poolRes[4]['J'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "M";
        $setCol = 2;
        $setRow = 8;
        $setSpan = 2;
        $setRonda = "Losers Round 1";
        $setEspera1 = "Bracket A2: Losers";
        $setEspera2 = "Bracket B2: Losers";
        $setFeed1 = "Bracket A2";
        $setFeed2 = "Bracket B2";
        include("pintar-set-final.php");

        /* ---------- N : loser of D vs winner of J ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['D'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['J'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "N";
        $setCol = 3;
        $setRow = 2;
        $setSpan = 2;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of D";
        $setEspera2 = "winner of J";
        include("pintar-set-final.php");

        /* ---------- O : loser of C vs winner of K ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['C'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['K'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "O";
        $setCol = 3;
        $setRow = 4;
        $setSpan = 2;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of C";
        $setEspera2 = "winner of K";
        include("pintar-set-final.php");

        /* ---------- P : loser of B vs winner of L ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['B'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['L'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "P";
        $setCol = 3;
        $setRow = 6;
        $setSpan = 2;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of B";
        $setEspera2 = "winner of L";
        include("pintar-set-final.php");

        /* ---------- Q : loser of A vs winner of M ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['A'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['M'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "Q";
        $setCol = 3;
        $setRow = 8;
        $setSpan = 2;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of A";
        $setEspera2 = "winner of M";
        include("pintar-set-final.php");

        /* ---------- R : winner of N vs winner of O ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['N'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['O'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "R";
        $setCol = 4;
        $setRow = 2;
        $setSpan = 4;
        $setRonda = "Losers Round 3";
        $setEspera1 = "winner of N";
        $setEspera2 = "winner of O";
        include("pintar-set-final.php");

        /* ---------- S : winner of P vs winner of Q ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['P'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['Q'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "S";
        $setCol = 4;
        $setRow = 6;
        $setSpan = 4;
        $setRonda = "Losers Round 3";
        $setEspera1 = "winner of P";
        $setEspera2 = "winner of Q";
        include("pintar-set-final.php");

        /* ---------- T : loser of E vs winner of R ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['E'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['R'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "T";
        $setCol = 5;
        $setRow = 2;
        $setSpan = 4;
        $setRonda = "Losers Quarter-Final";
        $setEspera1 = "loser of E";
        $setEspera2 = "winner of R";
        include("pintar-set-final.php");

        /* ---------- U : loser of F vs winner of S ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['F'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['S'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "U";
        $setCol = 5;
        $setRow = 6;
        $setSpan = 4;
        $setRonda = "Losers Quarter-Final";
        $setEspera1 = "loser of F";
        $setEspera2 = "winner of S";
        include("pintar-set-final.php");

        /* ---------- V : winner of T vs winner of U ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['T'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['U'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "V";
        $setCol = 6;
        $setRow = 2;
        $setSpan = 8;
        $setRonda = "Losers Semi-Final";
        $setEspera1 = "winner of T";
        $setEspera2 = "winner of U";
        include("pintar-set-final.php");

        /* ---------- W : loser of G vs winner of V ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($finalRes['G'], "perdedor", $usuario, $torneo, $idTorneoFinal);
        $setSlot2 = $eliminatoria->ctrCargarSlot($finalRes['V'], "ganador", $usuario, $torneo, $idTorneoFinal);
        $setLetra = "W";
        $setCol = 7;
        $setRow = 2;
        $setSpan = 8;
        $setRonda = "Losers Final";
        $setEspera1 = "loser of G";
        $setEspera2 = "winner of V";
        include("pintar-set-final.php");
    ?>
</div>
