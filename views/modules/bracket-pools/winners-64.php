<div class="bp-w-64 mb-14">
    <div class="bp-title bp-c1 bp-r1">Winners Round 1</div>
    <div class="bp-title bp-c2 bp-r1">Winners Quarter-Final</div>
    <div class="bp-title bp-c3 bp-r1">Winners Semi-Final</div>

    <?php
        /* ============================================================
           POOL DE 16 (torneo de 64, 4 pools)
           A-H = 8 enfrentamientos de R1 (seed baja vs 65-seed)
           Orden 16 jugadores: 1-16, 8-9, 4-13, 5-12, 2-15, 7-10, 3-14, 6-11
           I-L = ganadores de A-H de dos en dos
           M-N = ganadores de I-L → Top 16
           ============================================================ */
        $poolNum = (int) $_GET['pool'];
        $magico64 = 65;
        $favoritosR1 = array(1, 8, 4, 5, 2, 7, 3, 6);
        $letrasR1 = array("A", "B", "C", "D", "E", "F", "G", "H");
        $filasR1 = array(2, 3, 4, 5, 6, 7, 8, 9);

        for ($u = 0; $u < 8; $u++) 
        {
            $seedBajoNum = $poolNum + ($favoritosR1[$u] - 1) * 4;
            $seedAltoNum = $magico64 - $seedBajoNum;

            $seedBajo = $torneo->ctrSacarSeedDelTorneo($seedBajoNum, $_GET['id']);
            $seedAlto = $torneo->ctrSacarSeedDelTorneo($seedAltoNum, $_GET['id']);
            $jugadorBueno = $usuario->ctrSacarUsuario($seedBajo['id_jugador']);
            $jugadorMalo = $usuario->ctrSacarUsuario($seedAlto['id_jugador']);

            $eliminatoria->ctrCrearPartidaPreliminar($seedBajo['id_jugador'], $seedAlto['id_jugador'], $_GET['id'], $letrasR1[$u], $_GET['pool']);
            $cajaResumen = $eliminatoria->ctrSacarResumenSet($_GET['id'], $letrasR1[$u], $_GET['pool']);

            $cajaLetra = $letrasR1[$u];
            $cajaCol = 1;
            $cajaRow = $filasR1[$u];
            $cajaSpan = 1;
            $cajaRondaNombre = "Winners Round 1";
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
        }

        $resumenA = $eliminatoria->ctrSacarResumenSet($_GET['id'], "A", $_GET['pool']);
        $resumenB = $eliminatoria->ctrSacarResumenSet($_GET['id'], "B", $_GET['pool']);
        $resumenC = $eliminatoria->ctrSacarResumenSet($_GET['id'], "C", $_GET['pool']);
        $resumenD = $eliminatoria->ctrSacarResumenSet($_GET['id'], "D", $_GET['pool']);
        $resumenE = $eliminatoria->ctrSacarResumenSet($_GET['id'], "E", $_GET['pool']);
        $resumenF = $eliminatoria->ctrSacarResumenSet($_GET['id'], "F", $_GET['pool']);
        $resumenG = $eliminatoria->ctrSacarResumenSet($_GET['id'], "G", $_GET['pool']);
        $resumenH = $eliminatoria->ctrSacarResumenSet($_GET['id'], "H", $_GET['pool']);

        /* ---------- I : winner of A vs winner of B ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenA, "ganador", $usuario, $torneo, $_GET['id']);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenB, "ganador", $usuario, $torneo, $_GET['id']);
        $setLetra = "I";
        $setCol = 2;
        $setRow = 2;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "winner of A";
        $setEspera2 = "winner of B";
        $setTop16 = false;
        include("pintar-set-pool.php");

        /* ---------- J : winner of C vs winner of D ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenC, "ganador", $usuario, $torneo, $_GET['id']);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenD, "ganador", $usuario, $torneo, $_GET['id']);
        $setLetra = "J";
        $setCol = 2;
        $setRow = 4;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "winner of C";
        $setEspera2 = "winner of D";
        $setTop16 = false;
        include("pintar-set-pool.php");

        /* ---------- K : winner of E vs winner of F ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenE, "ganador", $usuario, $torneo, $_GET['id']);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenF, "ganador", $usuario, $torneo, $_GET['id']);
        $setLetra = "K";
        $setCol = 2;
        $setRow = 6;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "winner of E";
        $setEspera2 = "winner of F";
        $setTop16 = false;
        include("pintar-set-pool.php");

        /* ---------- L : winner of G vs winner of H ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenG, "ganador", $usuario, $torneo, $_GET['id']);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenH, "ganador", $usuario, $torneo, $_GET['id']);
        $setLetra = "L";
        $setCol = 2;
        $setRow = 8;
        $setSpan = 2;
        $setRonda = "Winners Quarter-Final";
        $setEspera1 = "winner of G";
        $setEspera2 = "winner of H";
        $setTop16 = false;
        include("pintar-set-pool.php");

        $resumenI = $eliminatoria->ctrSacarResumenSet($_GET['id'], "I", $_GET['pool']);
        $resumenJ = $eliminatoria->ctrSacarResumenSet($_GET['id'], "J", $_GET['pool']);
        $resumenK = $eliminatoria->ctrSacarResumenSet($_GET['id'], "K", $_GET['pool']);
        $resumenL = $eliminatoria->ctrSacarResumenSet($_GET['id'], "L", $_GET['pool']);

        /* ---------- M : winner of I vs winner of J → Top 16 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenI, "ganador", $usuario, $torneo, $_GET['id']);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenJ, "ganador", $usuario, $torneo, $_GET['id']);
        $setLetra = "M";
        $setCol = 3;
        $setRow = 2;
        $setSpan = 4;
        $setRonda = "Winners Semi-Final";
        $setEspera1 = "winner of I";
        $setEspera2 = "winner of J";
        $setTop16 = true;
        include("pintar-set-pool.php");

        /* ---------- N : winner of K vs winner of L → Top 16 ---------- */
        $setSlot1 = $eliminatoria->ctrCargarSlot($resumenK, "ganador", $usuario, $torneo, $_GET['id']);
        $setSlot2 = $eliminatoria->ctrCargarSlot($resumenL, "ganador", $usuario, $torneo, $_GET['id']);
        $setLetra = "N";
        $setCol = 3;
        $setRow = 6;
        $setSpan = 4;
        $setRonda = "Winners Semi-Final";
        $setEspera1 = "winner of K";
        $setEspera2 = "winner of L";
        $setTop16 = true;
        include("pintar-set-pool.php");
    ?>
</div>

<?php
    include("modal-resultados.php");
    include("modal-reportar.php");
?>

<script>
    const usuarioLogueado = <?php
        echo json_encode(UsuarioController::ctrComprobacionVersionModal());
    ?>;
</script>
