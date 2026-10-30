<?php

class UsuarioController
{
    public function ctrSacarUsuario($id)/*Sacar registros del usuario mediante el id*/
    {
        $tabla = "jugador";
        $respuesta = UsuariosModel::mdlSacarUsu($tabla, $id);
        return $respuesta;
    }

    public static function ctrComprobacion()
    {
        if (!isset($_SESSION['usuario'])) 
        {
            header("Location: login");
        }
    }

    public static function ctrComprobacionVersionModal()
    {
        return isset($_SESSION['usuario']);
    }

    public function ctrLoguearse()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $usuario = Funciones::sanar_datos($_POST['user'],'string',$error);
            $password = Funciones::sanar_datos($_POST['pass'],'string',$error);
            
            if (!empty($usuario) || !empty($password)) 
            {
                $contador =  UsuariosModel::mdlsacar_num_usuario($usuario,$password);
                if ($contador == 0) 
                {
                    $error = "Este usuario no existe o has escrito mal la contraseña";
                }
                else 
                {
                    $id = UsuariosModel::mdlsacarIdUsu($usuario);
                    $_SESSION['usuario'] = $usuario;
                    $_SESSION['id'] = $id;
                    if ($usuario == "admin") 
                    {
                        //header('Location: inicio');
                        echo "<script>
                        window.location = 'admin/inicio';
                        </script>";
                    }
                    else 
                    {
                        //header('Location: ../inicio');
                        echo "<script>
                        window.location = 'inicio';
                        </script>";
                    }
                } 
            }
            return $error;
        }
    }

    public function ctrRegistrarse()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') 
        {
            $usuario = Funciones::sanar_datos($_POST['usuario'],'string',$error);
            $nombre = Funciones::sanar_datos($_POST['nombre'],'string',$error);
            $apellidos = Funciones::sanar_datos($_POST['apellidos'],'string',$error);
            $password = Funciones::sanar_datos($_POST['password'],'string',$error);
            $password2 = Funciones::sanar_datos($_POST['password2'],'string',$error);
            
            if (!empty($usuario) || !empty($password) || !empty($password2)) 
            {
                if ($password == $password2) 
                {
                    $contador = UsuariosModel::mdlsacar_num_usuario($usuario,$password);
                    if ($contador == 1) 
                    {
                        $error = "Este usuario ya existe";
                    }
                    else 
                    {
                        $crearusu = UsuariosModel::mdlanadir_usu($usuario,$nombre,$apellidos,$password);
                        header('Location: login');
                    }
                }
                else {
                    $error = "Las contraseñas no son iguales";
                }
            }

            return $error;
        }
    }

    public function ctrEditarUsu()
    {
        if (isset($_POST['usu']))
        {
            $ruta = "";
            $foto = "";
            if (isset($_FILES["foto"]["tmp_name"]))
            {
                $foto = Funciones::sanar_datos($_FILES['foto'],'foto',$error);
            }
            else {
                $foto = "default.png";
            }
            $tabla = "jugador";
            $borrar_imagen = Funciones::borrar_imagenes($tabla,$_GET['id']);

            $datos = array("id" => $_GET['id'],
                        "usuario" => $_POST["usu"],
                        "pass" => $_POST["pass"],
                        "foto" => $foto);

            $respuesta = UsuariosModel::mdlEditarUsu($tabla, $datos);
            if ($respuesta == "SI")
            {
                echo "<script>
                        window.location = 'perfil';
                        </script>";
            }
            else {
                return $error;
            }
        }
    }

}