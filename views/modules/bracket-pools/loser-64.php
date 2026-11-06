<div class="bp-l-64">
    <div class="bp-title bp-c1 bp-r1">Losers Round 1</div>
    <div class="bp-title bp-c2 bp-r1">Losers Round 2</div>
    <div class="bp-title bp-c3 bp-r1">Losers Round 3</div>
    <div class="bp-title bp-c4 bp-r1">Losers Quarter-Final</div>

    <?php
        /* ============================================================
           LOSERS POOL 64 (16 jugadores)
           R-U = perdedores de A-H de dos en dos (como G/H en el 32)
           V-Y = perdedor de I-L vs ganador de R-U (cae el QF winners)
           Z/AA = ganadores de V-Y
           AB/AC = perdedor de M/N vs ganador de Z/AA → Top 16
           Un lado puede pintarse aunque el otro aún no haya llegado.
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
        $resumenI = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "I", $poolCaja);
        $resumenJ = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "J", $poolCaja);
        $resumenK = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "K", $poolCaja);
        $resumenL = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "L", $poolCaja);
        $resumenM = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "M", $poolCaja);
        $resumenN = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "N", $poolCaja);

        /* ---------- R : loser of A vs loser of B ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenA, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenB, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "R";
        $setCol = 1;
        $setRow = 2;
        $setSpan = 1;
        $setRonda = "Losers Round 1";
        $setEspera1 = "loser of A";
        $setEspera2 = "loser of B";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenR = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "R", $poolCaja);

        /* ---------- S : loser of C vs loser of D ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenC, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenD, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "S";
        $setCol = 1;
        $setRow = 3;
        $setSpan = 1;
        $setRonda = "Losers Round 1";
        $setEspera1 = "loser of C";
        $setEspera2 = "loser of D";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenS = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "S", $poolCaja);

        /* ---------- T : loser of E vs loser of F ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenE, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenF, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "T";
        $setCol = 1;
        $setRow = 5;
        $setSpan = 1;
        $setRonda = "Losers Round 1";
        $setEspera1 = "loser of E";
        $setEspera2 = "loser of F";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenT = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "T", $poolCaja);

        /* ---------- U : loser of G vs loser of H ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenG, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenH, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "U";
        $setCol = 1;
        $setRow = 6;
        $setSpan = 1;
        $setRonda = "Losers Round 1";
        $setEspera1 = "loser of G";
        $setEspera2 = "loser of H";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenU = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "U", $poolCaja);

        /* ---------- V : loser of I vs winner of R ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenI, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenR, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "V";
        $setCol = 2;
        $setRow = 2;
        $setSpan = 1;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of I";
        $setEspera2 = "winner of R";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenV = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "V", $poolCaja);

        /* ---------- W : loser of J vs winner of S ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenJ, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenS, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "W";
        $setCol = 2;
        $setRow = 3;
        $setSpan = 1;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of J";
        $setEspera2 = "winner of S";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenW = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "W", $poolCaja);

        /* ---------- X : loser of K vs winner of T ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenK, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenT, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "X";
        $setCol = 2;
        $setRow = 5;
        $setSpan = 1;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of K";
        $setEspera2 = "winner of T";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenX = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "X", $poolCaja);

        /* ---------- Y : loser of L vs winner of U ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenL, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenU, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "Y";
        $setCol = 2;
        $setRow = 6;
        $setSpan = 1;
        $setRonda = "Losers Round 2";
        $setEspera1 = "loser of L";
        $setEspera2 = "winner of U";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenY = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "Y", $poolCaja);

        /* ---------- Z : winner of V vs winner of W ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenV, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenW, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "Z";
        $setCol = 3;
        $setRow = 2;
        $setSpan = 2;
        $setRonda = "Losers Round 3";
        $setEspera1 = "winner of V";
        $setEspera2 = "winner of W";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenZ = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "Z", $poolCaja);

        /* ---------- AA : winner of X vs winner of Y ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenX, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenY, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "AA";
        $setCol = 3;
        $setRow = 5;
        $setSpan = 2;
        $setRonda = "Losers Round 3";
        $setEspera1 = "winner of X";
        $setEspera2 = "winner of Y";
        $setTop16 = false;
        include("pintar-set-pool.php");
        $resumenAA = $eliminatoria->ctrSacarResumenSet($idTorneoCaja, "AA", $poolCaja);

        /* ---------- AB : loser of M vs winner of Z → Top 16 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenM, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenZ, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "AB";
        $setCol = 4;
        $setRow = 2;
        $setSpan = 2;
        $setRonda = "Losers Quarter-Final";
        $setEspera1 = "loser of M";
        $setEspera2 = "winner of Z";
        $setTop16 = true;
        include("pintar-set-pool.php");

        /* ---------- AC : loser of N vs winner of AA → Top 16 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenN, "perdedor", $usuario, $torneo, $idTorneoCaja);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenAA, "ganador", $usuario, $torneo, $idTorneoCaja);
        $setLetra = "AC";
        $setCol = 4;
        $setRow = 5;
        $setSpan = 2;
        $setRonda = "Losers Quarter-Final";
        $setEspera1 = "loser of N";
        $setEspera2 = "winner of AA";
        $setTop16 = true;
        include("pintar-set-pool.php");
    ?>
</div>
