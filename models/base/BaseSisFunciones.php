<?php
namespace app\models\base;
use Yii;

/**
 * Send comprobantes
 */
class BaseSisFunciones 
{
	public static function setLog($mensaje,$mostrar = true){
		if($mostrar){
			$mensaje = date('Y-m-d H:i:s').' '.$mensaje;
			$fp = fopen('../../logs/logs.log', 'a+');
			echo '<br><br>'.$mensaje;
			fputs($fp,"\r\n".$mensaje);
			fgets($fp);
		}
	}
}