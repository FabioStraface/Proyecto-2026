<?php
    /* ============================================================
       POSICIONAMIENTO
       Solo se enseña con el torneo cerrado (estado true).
       Si alguien entra antes, lo mando al resumen.
       La tabla es la misma que en Participantes.
       ============================================================ */
    $torneo = new TorneoController();
    $valor = $torneo->ctrSacarTorneo($_GET['id']);
    if (empty($valor['estado'])) 
    {
        header("Location: torneo-resumen&id=".(int) $_GET['id']);
        exit;
    }

    include("cabecera.php");
?>

<section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Posicionamiento</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $eliminatoria = new PartidasController();
    $inscritos = $torneo->ctrSacarInscritosTorneo($_GET['id']);
    $standing = $eliminatoria->ctrSacarStandingParticipantes($_GET['id'], $inscritos);

    include("torneo-nav.php");
    include("torneo-standing.php");
?>
