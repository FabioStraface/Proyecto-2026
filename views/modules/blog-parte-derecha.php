<?php
  $torneo = new TorneoController();
  $valores = $torneo->ctrMostrarTorneoRecientesLimit(3);//Saca los 3 ultimos torneos
  $region = new RegionController();
  $valores2 = $region->ctrSacarRegiones();//Saca todas las regiones
?>
<div class="col-lg-4 col-sm-12 col-xs-12">
    <!--<div class="blog_search">
        <input type="text" class="form-control" placeholder="Type & Press Enter">
    </div>--> 
    <div class="latest_blog wow fadeInRight">
        <h4 class="blog_sidebar_title">Ultimos torneos</h4>
        <?php
            foreach ($valores as $key => $valor) 
            {
        ?> 
        <div class="single_latest_blog">							
            <a href="blog-single&id=<?= $valor['id_torneo'] ?>"><h4><?= $valor['nombre'] ?></h4></a>						
        </div>
        <?php
            }
        ?>
    </div>				
    <div class="tag">
        <h4 class="blog_sidebar_title">Regiones</h4><!-- Falta hacer enlaces de busqueda con js -->
        <?php
            foreach ($valores2 as $key => $region) 
            {
        ?>
        <a href="#"><?= $region['localidad'] ?></a>
        <?php
            }
        ?>
    </div>
</div><!--- END COL -->	