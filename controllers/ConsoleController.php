<?php

namespace app\controllers;

use Yii;
use app\models\Cuenta;
use app\models\SisConfiguraciones;
use app\models\Products;


/**
 * Site controller
 */
class ConsoleController extends \yii\console\Controller
{
    
	public function actionStock(){
		$products = Products::find()->where(['status'=>2])->all();
		$database = Yii::$app->firebase->getDatabase();
		$reference = $database->getReference('stocks/USB0126');
		$value = $reference->setValue([
			'description'=>'hola yii2',
			'onHand'=>1,
		]);
		/*
		foreach($products as $products){
			$reference = $database->getReference('stocks/' . $product->sku);
			$objetFinanza = json_decode($model->objetct); 
			foreach($objetFinanza->stock as $location){
				if(!is_null($warehouse)) {
					$value = $reference->setValue([
						'description'=>$warehouse->description,
						'onHand'=>$warehouse->onHand,
					]);
				}
			}
		}
		*/
	}
	// The command "yii example/create test" will call "actionCreate('test')"
	public function actionGetlastproducts($page = 39,$to = 50) {
		$init = date('H:i:s a');
        $existingCodes = Yii::$app->getDb()->createCommand('SELECT GROUP_CONCAT(`sku`) as skus FROM `wi_products` WHERE 1;')->queryAll();
		$existingCodes = $existingCodes[0]['skus'];
		
		$response = Products::callApiLambdaAllForCompare($page,$to);
		
		if(is_null($response['res']))
			return false;
		
		$data = $response['res']->data;
		$pagination = $response['res']->pagination;
		$newsSunc = 0;
				
		foreach($data as $i => $prod){
			if(isset($prod)) // Puede venir vacio porque en lambda no se lleno el array
				if($prod->description !== "NoUsar"){ //Saltar los no usar
				if (!str_contains($existingCodes, $prod->sku)) {
						$newProd = new Products();
						$newProd->sku = $prod->sku;
						$newProd->name = $prod->description;
						$newProd->objetct = '{}';
						$newProd->status = Products::STATUS_UNSYNC.'';
						$prod->status = Products::STATUS_UNSYNC;
						if(!$newProd->save()){
							var_dump($newProd->errors);
							die;
						}else{
							$newsSunc++;
						}
					}else{
						unset($data[$i]); //Se saca del arreglo si ya existe en la base de datos						
					}			
				}else{
					unset($data[$i]);			
				}			
			}
		if($newsSunc>0){
			echo 'Sin SKUs';
			Yii::$app->session->setFlash('info', 'Se han obtenido '.$newsSunc.' sku´s nuevos.');
		}else{
			echo 'Con Skus';
			Yii::$app->session->setFlash('info', 'Esta pagina no posee sku´s nuevos. '.$init.'-'.date('H:i:s a'));			
		}			
	 }
	
	
	// The command "yii example/create test" will call "actionCreate('test')"
    public function actionCreate($name) {
		echo 'hi '.$name;
	}

    // The command "yii example/index city" will call "actionIndex('city', 'name')"
    // The command "yii example/index city id" will call "actionIndex('city', 'id')"
    public function actionIndex($category, $order = 'name') {
		echo 'he';
	}

    // The command "yii example/add test" will call "actionAdd(['test'])"
    // The command "yii example/add test1,test2" will call "actionAdd(['test1', 'test2'])"
    public function actionAdd(array $name) { 
		echo 'ho';
	}
}