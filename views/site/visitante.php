<?php
use app\models\SisConfiguraciones;
use common\components\Moneda;
    
$path =  Yii::getAlias('@app').'/web/visitante/index.html';
$configs = SisConfiguraciones::getParametrosGenerales();     
     $frase = [
        'am'=>"¡ Buenos días !",
        'pm'=>"¡ Buenas tardes !",
        'noche'=>"¡ Buenas noches !"
     ];                     
     if (file_exists($path)) {         
        $lines = file($path);
        $escribir = false;
        foreach ($lines as $line_num => $line) { 
           if($escribir && strpos($line, 'script src="assets/web/assets/jquery/jquery.min.js'))
               $escribir = false;
           if ($escribir) {
                $line = str_replace('https://mobirise.com/','#',$line);
                $line = str_replace('https://mobirise.com','#',$line);
                $line = str_replace('assets/images/','/visitante/assets/images/',$line);
                $line = str_replace('SaludoHorario',$frase[Moneda::hora()],$line);
                $line = str_replace('Saludo','Un gusto saludarlo',$line);
                $line = str_replace('Slogan',$configs['NombreComercial'],$line);
                $line = str_replace('NombreCliente',$configs['Slogan'],$line);
                
                $line = str_replace('2730 2663',$configs['Telefono'],$line);
                $line = str_replace('27302663',$configs['Telefono'],$line);
                $line = str_replace('melvicdelsur@gmail.com',$configs['Correo'],$line);
                
                $line = str_replace('ResumenCliente','Resumen',$line);
                
                $line = str_replace('TituloNoticia1','Titulo',$line);
                $line = str_replace('DetalleNoticia1','detalle',$line);
                
                $line = str_replace('http://site.log','/site/login',$line);
                
                echo $line;           
           }
           if(strpos($line, 'body')){
               $escribir = true;
           }
           
        }
    }else{
        echo 'no hay home en '.$path;
    }
                        
                        
