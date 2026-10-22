<?php include("cabecera.php"); ?>	

<?php
    $torneo = new TorneoController();
    $valor = $torneo->ctrSacarTorneo($_GET['id']);
    $jugadores = new UsuarioController();
    $jugador = $jugadores->ctrSacarUsuario($valor['id_usuario']);
?>

<!-- START SECTION TOP -->
    <section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1><?= $valor['nombre'] ?></h1>		
                </div>
                </div><!--- END COL -->				  
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->		

    <!-- START BLOG -->
    <section class="blog-page section-padding">
        <div class="container">	
            <div class="row">
                <div class="col-lg-8 col-sm-12 col-xs-12">
                    <div class="post-slide-blog">
                        <div class="blog-img bc_bottom">
                            <img src="views/assets/img/blog/<?= $valor['img'] ?>" class="img-fluid" alt="image" />
                        </div>
                        <p><?= $valor['descripcion'] ?></p>
                    </div>
                    <div class="author_part">
                        <h3 class="blog_head_title">AUTOR: <?= $jugador['usuario'] ?></h3>
                        <div class="single_author">
                            <img src="views/assets/img/blog/<?= $jugador['img'] ?>" alt="" />
                            <h1 style="padding-top: 0.7em;"><?= $jugador['nombre'] ?> <?= $jugador['apellidos'] ?></h4>
                        </div>
                    </div><!--- END AUTHOR PART -->			
                </div><!-- END COL-->		
                <?php include("blog-parte-derecha.php"); ?>			
            </div><!-- END ROW-->
        </div><!-- END CONTAINER-->
    </section>
<!-- END BLOG -->	