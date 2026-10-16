<?php

class PaginacionController
{
    //los tres registros a pedir son la tabla, lugar donde va la pagina y el num que quieres paginar
    public function ctrPagina($tabla,$lugar,$paginacion)
    {
        $pagina = PaginacionModel::mdlTuPagina();
        $inicio = PaginacionModel::inicio_cada_pagina($pagina,$paginacion);
        $total = PaginacionModel::Total_registros($tabla);
        $num_paginas = ceil($total / $paginacion);
        $btn = PaginacionModel::btn($pagina,$num_paginas,$lugar);
        return $btn;
    }

    public function ctrMostrarRegistroPaginado($tabla,$pagina,$paginacion)
    {
        $inicio = PaginacionModel::inicio_cada_pagina($pagina,$paginacion);
        $respuesta = PaginacionModel::mdlMostrarRegistroConLimit($tabla,$inicio,$paginacion);

        return $respuesta;
    }
    
    public function ctrMostrarRegistroPaginadoYId($tabla,$pagina,$paginacion,$campo,$id)
    {
        $inicio = PaginacionModel::inicio_cada_pagina($pagina,$paginacion);
        $respuesta = PaginacionModel::mdlMostrarRegistroConLimitEId($tabla,$inicio,$paginacion,$campo,$id);

        return $respuesta;
    }
}