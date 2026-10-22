<?php
	if (isset($_GET['ruta'])) 
	{
		if ($_GET['ruta'] == 'inicio' ||
			$_GET['ruta'] == 'about' ||
			$_GET['ruta'] == 'servicios' ||
			$_GET['ruta'] == 'serv-ind' ||
			$_GET['ruta'] == 'casoestudio' ||
            $_GET['ruta'] == 'porfolio' ||
            $_GET['ruta'] == 'porfolio-ind' ||
            $_GET['ruta'] == 'porfolio-gal' ||
            $_GET['ruta'] == 'faq' ||
            $_GET['ruta'] == 'miembros' ||
            $_GET['ruta'] == 'precios' ||
            $_GET['ruta'] == 'blog' ||
            $_GET['ruta'] == 'blog-sidebar' ||
            $_GET['ruta'] == 'blog-single' ||
            $_GET['ruta'] == 'contacto' ||
			$_GET['ruta'] == 'misBlog' ||
			$_GET['ruta'] == 'carrito' ||
			$_GET['ruta'] == 'torneo-resumen' ||
			$_GET['ruta'] == 'bracket-pools' ||
			$_GET['ruta'] == 'bracket-final' ||
			$_GET['ruta'] == 'logout') {
			
			include ('modules/'.$_GET['ruta'].'.php');

			include("modules/footer.php");
		}
		elseif ($_GET['ruta'] == 'thank-you' ||
				$_GET['ruta'] == 'registrate' ||
				$_GET['ruta'] == 'login') {
			include ('modules/'.$_GET['ruta'].'.php');
		}
		else 
		{
		include ('modules/404.php');
		
		include("modules/footer.php");
		}
	}
	else 
	{
	include ('modules/inicio.php');

	include("modules/footer.php");
	}
?>		
        
        