<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SisConfiguraciones;
use app\models\Products;

use yii\web\NotFoundHttpException;
/**
 * Site controller
 */
class SyncController extends BaseController {

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    
    
    public function actionRefreshdata($desde,$hasta) {
		$models = Products::find()->where(['>=','id',$desde])->andWhere(['<=','id',$hasta])->all();
		foreach($models as $model){
			
			$productres = Products::callApiLambdaBySku($model->sku);
			$product = json_decode($productres); 
		
			$model = Products::find()->where(['sku'=>$product->sku])->one();
			$model->objetct = $productres;
			$model->cleanJsonLocations();
			$model->countStock();
			
			if(!$model->save()){
				var_dump($model->errors);
				die;
			}
			sleep(3);
		}
	}
    public function actionSku($sku) {
		if(empty($sku)){
			Yii::$app->session->setFlash('warning', 'Requiere un sku');
			return $this->redirect('index');
		}
		
		$productres = Products::callApiLambdaBySku($sku);
		$product = json_decode($productres);
		
		if(is_null($product))
		{				
			Yii::$app->session->setFlash('warning', 'No hay respuesta desde el servidor de lambda');
			return $this->redirect('index');
		}
		
		$model = Products::find()->where(['sku'=>$product->sku])->one();
		
		if(is_null($model)){
			$newProd = new Products();
			$newProd->sku = $product->sku;
			$newProd->name = $product->description;
			$newProd->objetct = $productres;
			$newProd->status = Products::STATUS_UNSYNC.'';			
			$newProd->template = '{}';
			
			$dataApiLambda = json_decode($newProd->objetct);
			$dataApiLambdaStock = json_decode(json_encode($dataApiLambda->stock,true));
			if(count($dataApiLambdaStock) > 0)
				$newProd->hasStocks = 1;
			
			if(!$newProd->save()){
				var_dump($newProd->errors);
				die;
			}else{
				$newProd->cleanJsonLocations();				
				Yii::$app->session->setFlash('info', 'Se han obtenido un sku´s nuevo.');
				return $this->redirect(['/products/update','id'=>$product->id]);
			}
		}else{
			$model->objetct = $productres;
			$model->cleanJsonLocations();
		}
		
		Yii::$app->session->setFlash('success', 'Se han obtenido los datos desde FinanzaPro para este producto.');
		return $this->redirect(['/products/update','id'=>$model->id]);
		
	}
	 public function actionAll($page = 29,$to = 40) {
		$init = date('H:i:s a');
        $existingCodes = Yii::$app->getDb()->createCommand('SELECT GROUP_CONCAT(`sku`) as skus FROM `wi_products` WHERE 1;')->queryAll();
		$existingCodes = $existingCodes[0]['skus'];
		
		$response = Products::callApiLambdaAllForCompare($page,$to);
		
		if(is_null($response['res']))
		{				
			Yii::$app->session->setFlash('warning', 'No hay respuesta desde el servidor de lambda');
			return $this->redirect('index');
		}
		
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
			Yii::$app->session->setFlash('info', 'Se han obtenido '.$newsSunc.' sku´s nuevos.');
			return $this->render('perpage',['data'=>$data,'pagination'=>$pagination]);	
		}else{
			Yii::$app->session->setFlash('info', 'Esta pagina no posee sku´s nuevos. '.$init.'-'.date('H:i:s a'));			
		}
		
		return $this->render('index',['data'=>$data,'pagination'=>$pagination]);	
	 }
	
    public function actionPerpage($pe,$pp) {
		
		if($pe == '')
			$pe = 1;
		
		if($pp == '')
			$pp = 1500;
		
		$response = Products::callApiLambdaByPerPage($pe,$pp);
		if(is_null($response))
		{				
			Yii::$app->session->setFlash('warning', 'No hay respuesta desde el servidor de lambda');
			return $this->redirect('index');
		}
		
		$data = $response['res']->data;
		$pagination = $response['res']->pagination;
		$newsSunc = 0;
		
		foreach($data as $i => $prod){
			if(isset($prod)) // Puede venir vacio porque en lambda no se lleno el array
				if($prod->description !== "NoUsar"){ //Saltar los no usar
					if(!Products::find()->where(['sku'=>$prod->sku])->exists()){
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
			Yii::$app->session->setFlash('info', 'Se han obtenido '.$newsSunc.' sku´s nuevos.');
			return $this->render('perpage',['data'=>$data,'pagination'=>$pagination]);	
		}else{
			Yii::$app->session->setFlash('info', 'Esta pagina no posee sku´s nuevos.');			
		}
		
		return $this->render('index',['data'=>$data,'pagination'=>$pagination]);	
	}
	
    public function actionIndex() {
		return $this->render('index');
    }
}
