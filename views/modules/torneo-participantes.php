<?php include("cabecera.php"); ?>

<section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Participantes</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    /* ============================================================
       DATOS DEL TORNEO Y LISTA DE APUNTADOS
       Relleno NPC si faltan plazas, luego saco nick, seed e imagen.
       ============================================================ */
    $torneo = new TorneoController();
    $eliminatoria = new PartidasController();
    $valor = $torneo->ctrSacarTorneo($_GET['id']);
    $torneo->ctrRellenarConNpc($_GET['id']);
    $inscritos = $torneo->ctrSacarInscritosTorneo($_GET['id']);
    $standing = $eliminatoria->ctrSacarStandingParticipantes($_GET['id'], $inscritos);

    /* ============================================================
       ORDEN DE PARTICIPANTES
       Quien se apuntó antes va primero. Si empatan en fecha, seed.
       Posicionamiento sigue ordenando por resultado del cuadro.
       ============================================================ */
    usort($standing, function($a, $b) {
        $fechaA = strtotime($a['fecha_inscripcion']);
        $fechaB = strtotime($b['fecha_inscripcion']);
        if ($fechaA != $fechaB) 
        {
            return ($fechaA < $fechaB) ? -1 : 1;
        }

        return ($a['seed'] < $b['seed']) ? -1 : 1;
    });

    include("torneo-nav.php");
    /* En participantes solo lista: nick + seed, sin puesto ni W-L */
    $tpListaSimple = true;
    include("torneo-standing.php");
?>
