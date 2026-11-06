<?php
    /* ============================================================
       REPORTAR DE LA BRACKET FINAL
       Los sets de la final se guardan con pools = 0.
       ============================================================ */
    if (isset($_POST['game1']) && isset($_POST['ronda_letra']) && isset($_POST['jugador1']) && isset($_POST['jugador2']))
    {
        $eliminatoriaPost = new PartidasController();
        $poolsPost = isset($_POST['pools']) ? $_POST['pools'] : 0;
        $eliminatoriaPost->ctrReportar($_POST['jugador1'], $_POST['jugador2'], $_GET['id'], $_POST['ronda_letra'], $poolsPost);
        $idTorneoPost = (int) $_GET['id'];
        $poolPost = isset($_GET['pool']) ? (int) $_GET['pool'] : 1;
        header("Location: bracket-final&id=".$idTorneoPost."&pool=".$poolPost);
        exit;
    }

    include("cabecera.php");
?>

<section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Bracket Final</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $torneo = new TorneoController();
    $usuario = new UsuarioController();
    $eliminatoria = new PartidasController();
    $valor = $torneo->ctrSacarTorneo($_GET['id']);
    $torneo->ctrRellenarConNpc($_GET['id']);

    $fechaActual = date("d/m/Y");
    $fechaInicio = date("d/m/Y", strtotime($valor['fecha_inicio']));
    $fechaFinal = date("d/m/Y", strtotime($valor['fecha_fin']));

    include("torneo-nav.php");
?>

<section class="bg-[#f4f6f8] px-4 py-6 font-sans">
    <div class="bp-bracket-page mx-auto">

        <?php
        if ($fechaInicio > $fechaActual) 
        {
        ?>
            <H1>no estan publicados todavia</H1>
        <?php
        }
        else 
        {
            include("bracket-final/cargar-sets-final.php");
            include("bracket-final/winners-final.php");
            include("bracket-final/loser-final.php");
            include("bracket-pools/modal-resultados.php");
            include("bracket-pools/modal-reportar.php");
        ?>
        <script>
            const usuarioLogueado = <?php echo json_encode(UsuarioController::ctrComprobacionVersionModal()); ?>;
        </script>
        <?php
        }
        ?>

    </div>
</section>
