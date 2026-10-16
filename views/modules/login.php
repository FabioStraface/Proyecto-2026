<link rel="stylesheet" href="views/assets/css/app.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
      <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
      <link rel="stylesheet" href="views/assets/css/css_login.css">

<body>
    <div class="container">
      <div class="row">
		   <div class="col-md-5 mx-auto">
		      <div id="first">
<?php 
    $login = new UsuarioController();
    $error = $login->ctrLoguearse();
?>
				<div class="myform form ">
               <div class="logo mb-3">
                  <div class="col-md-12 text-center">
                     <h1>Inicia Sesión</h1>
                  </div>
               </div>
               <?php
                  if (!empty($error))
                  {
                     ?>
                     <div class="alert alert-danger" role="alert">
                        <?= $error ?>
                     </div>
                     <?php
                  }
               ?>
               <form action="" method="post" name="login">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Usuario</label>
                     <input type="text" name="user"  class="form-control" id="user" aria-describedby="emailHelp" placeholder="Introduce usuario">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">contraseña</label>
                     <input type="password" name="pass" id="pass"  class="form-control" aria-describedby="emailHelp" placeholder="Introduce contraseña">
                  </div>
                  <div class="col-md-12 text-center ">
                     <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Inicia Sesión</button>
                  </div>
                  <div class="col-md-12 ">
                     <div class="login-or">
                        <hr class="hr-or">
                        <span class="span-or">o</span>
                     </div>
                  </div>
                  <div class="form-group">
                     <p class="text-center">No tienes cuenta? <a href="registrate" id="signup">Registrate</a></p>
                  </div>
                  <div class="form-group">
                     <p class="text-center">Quieres volver al inicio? <a href="inicio" id="signup">Inicio</a></p>
                  </div>
               </form>
				</div>
			</div>
		</div>
      </div>   
         
</body>

<script src="views/assets/js/login.js"></script>