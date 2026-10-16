<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Monoline - Design Agency HTML Template">
    <meta name="keywords" content="agency, business, corporate, creative, html5, modern, multipurpose, One Page, parallax, startup ">		
    <!-- SITE TITLE -->
    <title>Monoline - Design Agency HTML Template</title>			
    <!-- Latest Bootstrap min CSS -->
    <link rel="stylesheet" href="views/assets/bootstrap/css/bootstrap.min.css">		
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800"> 
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:300,400,500,600">			
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="views/assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="views/assets/fonts/themify-icons.css">
    <!--- owl carousel Css-->
    <link rel="stylesheet" href="views/assets/owlcarousel/css/owl.carousel.css">
    <link rel="stylesheet" href="views/assets/owlcarousel/css/owl.theme.css">
    <!--materialdesignicons Css-->
    <link rel="stylesheet" href="views/assets/css/fonts.css">		
    <!-- animate CSS -->
    <link rel="stylesheet" href="views/assets/css/animate.css">					
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="views/assets/css/magnific-popup.css">					
    <!-- Style CSS -->						
    <link rel="stylesheet" href="views/assets/css/menu.css">			
    <link rel="stylesheet" href="views/assets/css/style.css">			
    <link rel="stylesheet" href="views/assets/css/responsive.css">			
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body data-spy="scroll" data-offset="80">

    <!-- START PRELOADER -->
    <div class="preloader">
        <div class="spinner">
            <div class="double-bounce1"></div>
            <div class="double-bounce2"></div>
        </div>
    </div>
    <!-- END PRELOADER -->		

        <!-- START NAVBAR -->
    <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
        <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
        </div>
        </div>
        <div class="site-mobile-menu-body"></div>
    </div>
    
    <header class="site-navbar js-sticky-header site-navbar-target" role="banner">
        <div class="container">
        <div class="row align-items-center">       
            <div class="col-6 col-xl-2">
            <h1 class="mb-0 site-logo"><a href="inicio"><img src="views/assets/img/logo.png" alt=""></a></h1>
            </div>
            <div class="col-12 col-md-10 d-none d-xl-block">
            <nav class="site-navigation position-relative text-right" role="navigation">
                <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">	
                    <li><a class="nav-link" href="about">Sobre Nosotros</a></li>
                    <li class="has-children">
                        <a href="servicios" class="nav-link">Servicios</a>
                        <ul class="dropdown">
                            <li><a href="serv-ind" class="nav-link">Servicio Individual</a></li>
                        </ul>
                    </li>					 
                        <li><a class="nav-link" href="casoestudio">Caso estudio</a></li>									
                    <li class="has-children">
                        <a href="porfolio" class="nav-link">Portfolio</a>
                        <ul class="dropdown">
                            <li><a href="porfolio-gal" class="nav-link">Galeria</a></li>
                            <li><a href="porfolio-ind" class="nav-link">Portfolio Individual</a></li>
                        </ul>
                    </li>	
                    <li class="has-children">
                        <a href="#" class="nav-link">Paginas</a>
                        <ul class="dropdown">
                            <li><a href="faq" class="nav-link">FAQ</a></li>
                            <li><a href="404" class="nav-link">404</a></li>
                            <li><a href="miembros" class="nav-link">Miembros</a></li>
                            <li><a href="precios" class="nav-link">Precio</a></li>
                        </ul>
                    </li>					
                    <li class="has-children">
                        <a href="blog-sidebar" class="nav-link">Blog</a>
                        <ul class="dropdown">
                            <li><a href="blog" class="nav-link">Blog Feo</a></li>
                            <li><a href="blog-single" class="nav-link">Blog Individual</a></li>
                        </ul>
                    </li>				
                    <li><a class="nav-link" href="contacto">Contacto</a></li>
                    <?php
                        if (!isset($_SESSION['usuario'])) 
                        {
                    ?>  
                    <li><a class="nav-link" href="login">Login</a></li>	
                    <?php
                        }
                        else 
                        {
                    ?>			
                    <li><a class="nav-link" href="perfil">Perfil</a></li>
                    <li><a class="nav-link" href="logout">Desconectarse</a></li>	
                    <?php
                        }
                    ?> 
                </ul>
            </nav>
            </div>
            <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;">
            <a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a>
            </div>
        </div>
        </div>
    </header>
<!-- END NAVBAR-->		