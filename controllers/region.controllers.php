<?php

class RegionController
{
    public function ctrSacarRegion($id)/*Sacar registros mediante el id*/
    {
        $tabla = "region";
        $respuesta = RegionModel::mdlSacarRegion($tabla, $id);
        return $respuesta;
    }

    public function ctrSacarRegiones()
    {
        $tabla = "region";
        $respuesta = RegionModel::mdlSacarRegiones($tabla);
        return $respuesta;
    }
}