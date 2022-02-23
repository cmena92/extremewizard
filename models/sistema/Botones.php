<?php
 namespace app\models\sistema;


class Botones {    
    public static function eliminar($accion,$parametros){
        return '<a
                title="Eliminar pedido"
                href ="'.$accion.'&'.$parametros.'"
                class="btn btn-danger" >
                    <span class="glyphicon glyphicon-trash"></span>
                </a>';
    } 
    
    public static function actualizar($accion,$parametros){
        return '<a 
                title="Actualizar" 
                href="'.$accion.'&'.$parametros.'" 
                class="btn btn-success">
                    <span class="glyphicon glyphicon-pencil"></span>
                </a>';
    }
    
    public static function Buscar($accion,$parametros,$label){
        return '<a 
                title="Buscar" 
                href="'.$accion.'&'.$parametros.'" 
                class="btn btn-info">
                    '.$label.'<span class="glyphicon glyphicon-search"></span>
                </a>';
    }
    
    public static function Consultar($accion,$parametros,$label){
        return '<a 
                title="Consultar"
                data-toggle="tooltip"
                href="'.$accion.'?'.$parametros.'" 
                class="btn btn-info">
                    '.$label.' <span class="glyphicon glyphicon-eye-open"></span>
                </a>';
    }
}
