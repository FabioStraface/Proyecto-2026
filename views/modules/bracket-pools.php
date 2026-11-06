<?php
    /* ============================================================
       REPORTAR ANTES DE PINTAR HTML
       Si proceso el POST a mitad de pagina, el navegador recibe
       un redirect con la sesion PHP todavía abierta y se queda
       cargando sin terminar. Por eso guardo, redirijo y salgo.
       ============================================================ */
    if (isset($_POST['game1']) && isset($_POST['ronda_letra']) && isset($_POST['jugador1']) && isset($_POST['jugador2']))
    {
        $eliminatoriaPost = new PartidasController();
        $poolsPost = isset($_POST['pools']) ? $_POST['pools'] : $_GET['pool'];
        $eliminatoriaPost->ctrReportar($_POST['jugador1'], $_POST['jugador2'], $_GET['id'], $_POST['ronda_letra'], $poolsPost);
        $idTorneoPost = (int) $_GET['id'];
        $poolPost = (int) $_GET['pool'];
        header("Location: bracket-pools&id=".$idTorneoPost."&pool=".$poolPost);
        exit;
    }

    include("cabecera.php");
?>

<section class="section-top"
    style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Pool A1</h1>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
    $torneo = new TorneoController();
    $usuario = new UsuarioController();
    $eliminatoria = new PartidasController();
    $valor = $torneo->ctrSacarTorneo($_GET['id']); //Saca todos los datos del torneo correspondiente
    /* Plazas vacias → NPC1, NPC2... para poder pintar el cuadro */
    $torneo->ctrRellenarConNpc($_GET['id']);

    // Fechas actuales y del torneo
    $fechaActual = date("d/m/Y");
    $fechaInicio = date("d/m/Y", strtotime($valor['fecha_inicio']));
    $fechaFinal = date("d/m/Y", strtotime($valor['fecha_fin']));

    // ABECEDARIO
    $abecedario = range('A', 'Z');

    //Sacar Seeding del torneo
    $seeds = $torneo->ctrSacarSeeding($_GET['id']);

    include("torneo-nav.php");
    //var_dump($pools);

    /*echo "<pre>";
    var_dump($_SERVER['REQUEST_METHOD']);
    var_dump($_POST);
    echo "</pre>";*/
?>

<section class="bg-[#f4f6f8] px-4 py-6 font-sans">
    <!-- Sin overflow-x-auto: esa clase pinta la barra de desplazamiento -->
    <div class="bp-bracket-page mx-auto">

        <?php
        if ($fechaInicio > $fechaActual) 
        {
        ?>
            <H1>no estan publicados todavia</H1>
        <?php
            }
            elseif ($fechaFinal < $fechaActual) 
            {
        ?>
            <H1>ESTO ES SI ESTA COMPLETO ESTO PA EL FINAL</H1>
        <?php
            }
            else 
            {
               
                if ($valor['max_entrant'] == 32) 
                {
                    include("bracket-pools/winners-32.php");

                    include("bracket-pools/loser-32.php");
                }
                else
                {
                    include("bracket-pools/winners-64.php");

                    include("bracket-pools/loser-64.php");
                }
                
            }
        ?>

    </div>
</section>