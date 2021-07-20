<?php

namespace App\Models\Admin;

class Funciones
{

    public function _CodigoFunciones($codigo, $arreglo)
    {
        $respuesta = null;
        try {
            if ($codigo == '1') {
                $respuesta = array('0' => "Registro guardado exitosamente", '1' => "success");
            } else if ($respuesta['code'] !== null && $respuesta['code'] == '1062') {
                $respuesta = array('0' => "Error registro duplicado", '1' => "error");
            } else {
                $errorRes = null;
                foreach ((array) $arreglo as $field => $error) {
                    $errorRes .= $error;
                    break;
                }
                $respuesta = array('0' => $errorRes, '1' => "error");
            }
        } catch (\Exception  $e) {
            $respuesta = array('0' => "Ocurrió un error interno". $e->getMessage(), '1' => "error");
        }
        return $respuesta;
    }

    public function _GuardarImagen($file,$ruta,$arreglo,$campobd)
    {
        $nombreImg = null;
        if ($img = $file) {
          if ($img->isValid() && !$img->hasMoved()) {
            $nombreImg = $img->getName();
            $resImg = $img->move($ruta, $nombreImg);
            return array_merge($arreglo, array("imagen" => $nombreImg));;
          }
        }
        return $arreglo;
    }
}
