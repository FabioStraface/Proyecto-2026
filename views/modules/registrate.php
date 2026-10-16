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
    $error = $login->ctrRegistrarse();
?>
				<div class="myform form ">
               <div class="logo mb-3">
                  <div class="col-md-12 text-center">
                     <h1>Registrate</h1>
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
               <form action="" method="post" name="registration">
                  <div class="form-group">
                     <label for="exampleInputEmail1">Usuario</label>
                     <input type="text"  name="usuario" class="form-control" id="usuario" aria-describedby="emailHelp" placeholder="Introduce usuario">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Nombre</label>
                     <input type="text"  name="nombre" class="form-control" id="nombre" aria-describedby="emailHelp" placeholder="Introduce nombres">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Apellidos</label>
                     <input type="text" name="apellidos"  class="form-control" id="apellidos" aria-describedby="emailHelp" placeholder="Introduce apellidos">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Contraseña</label>
                     <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Introduce contraseña">
                  </div>
                  <div class="form-group">
                     <label for="exampleInputEmail1">Verificación contraseña</label>
                     <input type="password" name="password2" id="password2"  class="form-control" aria-describedby="emailHelp" placeholder="Repite la contraseña">
                  </div>
                  <div class="col-md-12 text-center mb-3">
                     <button type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Registrate</button>
                  </div>
                  <div class="col-md-12 ">
                     <div class="form-group">
                        <p class="text-center"><a href="login" id="signin">Ya tienes cuenta?</a></p>
                     </div>
                  </div>
                     </div>
               </form>
				</div>
			</div>
		</div>
      </div>   
         
</body>

<script src="views/assets/js/login.js"></script>