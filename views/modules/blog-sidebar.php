<?php include("cabecera.php"); ?>	

<!-- START SECTION TOP -->
    <section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Torneos</h1>		
                </div>
                </div><!--- END COL -->				  
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->		

<?php
  $pag = new PaginacionController();
  $btn = $pag->ctrPagina("torneo","blog-sidebar",3);
  $pagina = PaginacionModel::mdlTuPagina();
  $valores = $pag->ctrMostrarRegistroPaginado("torneo",$pagina,3);
  $regiones = new RegionController();
?>

    <!-- START BLOG -->
    <section class="blog-page section-padding">
        <div class="container">	
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-xs-12">
                    <?php
                        foreach ($valores as $key => $valor) 
                        {
                        $region = $regiones->ctrSacarRegion($valor['id_region']);
                    ?> 

                    <div class="home_single_blog">
                        <img src="views/assets/img/blog/<?= $valor['img'] ?>" class="img-fluid" alt="blog-image" />
                        <div class="home_blog_content">
                            <div class="blog_title_info">
                                <h2><a href="blog-single&id=<?= $valor['id_torneo'] ?>"><?= $valor['nombre'] ?></a></h2>
                                <span><?= date("d/m/Y", strtotime($valor['fecha_inicio'])) ?> - <?= date("d/m/Y", strtotime($valor['fecha_fin'])) ?></span>
                                <span><a href="blog-single&id=<?= $valor['id_torneo'] ?>"><?= $region['localidad'] ?></a></span>
                            </div>
                            <p><?= $valor['descripcion'] ?></p>
                            <a class="home_b_btn" href="blog-single&id=<?= $valor['id_torneo'] ?>">Leer más</a>
                        </div>
                    </div>
                    <?php
                        }
                    ?>		
                    <div class="row mt-5">
                        <div class="col-12" style="text-align: center;">
                            <div class="block-27">
                                <nav aria-label="Paginación">
                                    <ul class="pagination justify-content-center">
                                        <?php echo $btn; ?>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>		
                </div><!-- END COL-->		
               	<?php include("blog-parte-derecha.php"); ?>			
            </div><!-- END ROW-->
        </div><!-- END CONTAINER-->
    </section>
<!-- END BLOG -->		