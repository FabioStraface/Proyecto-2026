<?php
  
require_once("conexion.model.php");

class Funciones {
    static public function sanar_datos($campo,$tipo,&$error)
    {
        if(isset($campo) && !empty($campo))
        {
            switch($tipo)
            {
                case "string":/*comprueba si es un string*/
                    $campo = filter_var(stripslashes($campo),FILTER_SANITIZE_STRING);
                    return $campo;
                break;
                case "email":/*comprueba si es un email*/
                    $campo = filter_var($campo,FILTER_SANITIZE_EMAIL);
                    if(filter_var($campo,FILTER_VALIDATE_EMAIL))
                    {return $campo;}
                    else{$error .="email invalido";}
                break;
                case "pass":/*comprueba si es una foto*/
                    $campo = filter_var(stripslashes($campo),FILTER_SANITIZE_STRING);
                    $campo = hash('sha512', $campo);
                    return $campo;
                break;
                case "int":/*comprueba si es un numero*/
                    $campo = (int)$campo;
                    $campo = floor($campo);
                    if($campo == ""){$campo = 0;}
                    return $campo;
                break;
                case "foto":/*comprueba si es una imagen*/
                    $rand = rand();
                    if(!empty($_FILES))
                    {
                        if($_FILES["foto"]["size"]>0)
                        {
                            $comprueba = @getimagesize($_FILES["foto"]["tmp_name"]);
                            if($comprueba != false){
                                $ruta = "admin/views/images/faces/".$rand."".$_FILES["foto"]["name"];
                                move_uploaded_file($_FILES["foto"]["tmp_name"],$ruta);
                                $campo = $_FILES["foto"]["name"];
                                $campo = $rand."".$campo;
                                return $campo;
                            }
                            else{$error = "El archivo no es una imagen";}
                        }
                        else{$campo = "default.png";return $campo;}
                        
                    }else{$campo = "default.png";return $campo;}
                break;
            }
        }
        else{$error = "Campo vacio";}
    }

    static public function borrar_consulta($tabla,$ids)
    {
        $conexion = Conexion::conectar();
        $sql = "DELETE FROM $tabla WHERE id LIKE $ids";
        $consulta = $conexion->query($sql);
        $registro = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $registro;
    }
    

    static public function borrar_imagenes($tabla,$id)
    {
        $conexion = Conexion::conectar();
        $consulta2="SELECT * FROM $tabla WHERE id LIKE '$id'";
        $registro2 = $conexion->query($consulta2);
        $registro = $registro2->Fetch();
        
        $consulta="SELECT * FROM $tabla WHERE img LIKE '".$registro['img']."'";
        $registrou = $conexion->query($consulta);
        $total = $registrou->rowCount();

        if ($registro['img'] != "default.png" && $total == 1) 
        {
            unlink("admin/views/images/faces/".$registro['img']);
        }
        return $total;
    }
}