<?php include("cabecera.php"); ?>

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

    // Fechas actuales y del torneo
    $fechaActual = date("d/m/Y");
    $fechaInicio = date("d/m/Y", strtotime($valor['fecha_inicio']));
    $fechaFinal = date("d/m/Y", strtotime($valor['fecha_fin']));

    // ABECEDARIO
    $abecedario = range('A', 'Z');

    //Sacar Seeding del torneo
    $seeds = $torneo->ctrSacarSeeding($_GET['id']);
    //var_dump($pools);
    /*foreach ($seeds as $key => $value) 
    {
        echo $value['SeedAlto'];
        echo " - ";
        echo $value['SeedBajo'];
        echo "<br>";
    }*/

    echo "<pre>";
    var_dump($_SERVER['REQUEST_METHOD']);
    var_dump($_POST);
    echo "</pre>";

    $report = $eliminatoria->ctrReportar();
    var_dump($report);
?>

<section class="bg-[#f4f6f8] px-4 py-6 font-sans">
    <div class="mx-auto w-fit max-w-full overflow-x-auto">

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