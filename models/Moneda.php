<?php
 namespace app\models;


class Moneda {
   
    public static function getreporte($pMonto){    
		// ₡ $   
        return  number_format($pMonto, 2, ',', '');
    
    }
    
    public static function get($pMonto){    
		// ₡ $   
        return  '₡ '.number_format($pMonto, 2, ',', ' ');
    
    }

    public static function gettm($pMonto,$moneda){    
		// ₡ $   
        return  $moneda.' '.number_format($pMonto, 2, ',', ' ');
    
    }
	public static function repgettm($pMonto){    
        return  number_format($pMonto, 2, ',', ' ');
    
    }
    public static function repgettmm($pMonto){    
        return  number_format($pMonto, 2, '.', ' ');
    
    }
    public static function hora(){
        date_default_timezone_set('America/Costa_Rica');
        $hora = date("g");
        $ampm = date("a");
        if ($ampm === "am") 
            $momento = 'am';
        else
            if ($hora <= 17) 
                $momento = 'pm';
            else 
                $momento = 'noche';
      return $momento;
    }
}
