<?php
session_start();

/*Inserto todos los controladores a toda la App*/ 
require_once('controllers/template.controllers.php');/*controlador pa ir a la pagina template*/ 
require_once('controllers/usuarios.controllers.php');/*controlador para loguearse los usuarios*/
require_once('controllers/torneos.controller.php');/*controlador relacionado con la seccion del torneo*/ 
require_once('controllers/paginacion.controllers.php');/*controlador relacionado con la paginacion y muestras de listados*/ 

/*Inserto todos los models a toda la App*/ 
require_once('models/usuarios.model.php');/*model para loguearse los usuarios*/ 
require_once('models/funciones.model.php');/*model de cosas multiusos*/ 
require_once('models/torneos.model.php');/*model relacionado con la seccion del torneo*/ 
require_once('models/paginacion.model.php');/*model relacionado con la paginacion y muestras de listados*/ 

$mvc = new TemplateController();
$mvc -> ctrplantilla();