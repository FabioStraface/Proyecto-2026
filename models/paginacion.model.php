<?php
  
require_once("conexion.model.php");

// $num_paginas = ceil($total / $paginacion); Para sacar numero de paginas

class PaginacionModel{

    public static function mdlTuPagina()
    {
        if (isset($_GET['pagina'])) 
        {
            $pagina = (int) $_GET['pagina'];//lo vuelve un numero en vez de string
            if (intval($_GET['pagina']) != 0) 
            {
                $pagina = (int) $_GET['pagina'];
            }
            else 
            {
                $pagina = 1;
            }
        }
        else 
        {
            $pagina = 1;
        }

        return $pagina;
    }

    public static function inicio_cada_pagina($pagina,$paginacion)
    {
        if ($pagina > 1) 
        {
            $inicio = $paginacion * $pagina - $paginacion;
        }
        else 
        {
            $inicio = 0;
        }
        return $inicio;
    }

    public static function mdlMostrarRegistroConLimit($tabla,$inicio,$paginacion)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla LIMIT $inicio,$paginacion");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    public static function mdlMostrarRegistroConLimitEId($tabla,$inicio,$paginacion,$campo,$id)
    {
        $conexion = Conexion::conectar();
        $consulta = $conexion->query("SELECT * FROM $tabla WHERE $campo LIKE '$id' LIMIT $inicio,$paginacion");
        $registros = $consulta->fetchAll(PDO::FETCH_ASSOC);
        return $registros;

        $sentencia->close();
        $sentencia = null;
    }

    public static function btn($pagina,$num_paginas,$lugar)
    {
        $string = '';
        if ($pagina == 1) 
        {
            $string = "<li class='page-item'><a class='page-link' href='$lugar&pagina=1' disabled>&lt;</a></li>";
        }
        else 
        {
            $string = "<li class='page-item'><a class='page-link' href='$lugar&pagina=".($pagina - 1)."'>&lt;</a></li>";
        }
        
        if ($num_paginas > 1) 
        {
            for ($i=1; $i <= $num_paginas; $i++) 
            {
                if ($i == $pagina) 
                {
                    $string .= "<li class='page-item active'><a class='page-link' href='$lugar&pagina=$i'>$i</a></li>";
                }
                else 
                {
                    $string .= "<li class='page-item'><a class='page-link' href='$lugar&pagina=$i'>$i</a></li>";
                }
            }
        }
        else 
        {
            return null;
        }
        

        if ($pagina == $num_paginas) 
        {
            $string .= "<li class='page-item'><a class='page-link' href='$lugar&pagina=$num_paginas'>&gt;</a></li>";
        }
        else 
        {
            $string .= "<li class='page-item'><a class='page-link' href='$lugar&pagina=".($pagina+1)."'>&gt;</a></li>";
        }

        return $string;
    }

    public static function Total_registros($tabla)
    {
        $conexion = Conexion::conectar();
        $consulta="SELECT SQL_CALC_FOUND_ROWS * FROM $tabla";
        $registros = $conexion->query($consulta);
        $total = $registros->rowCount();
        return $total;
    }
}