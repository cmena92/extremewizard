<?php

namespace app\controllers;

use Yii;
use app\models\LoginForm;
use app\models\SisConfiguraciones;
use app\models\Cuenta;
use app\models\Warehouses;
use app\models\Stores;
use yii\web\Response;

/**
 * Site controller
 */
class BranchController extends BaseController {

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

    
    
    public function actionIndex() {
		return $this->render('index');
    }
	
	public function actionBranches(){
			
			$url = Yii::$app->params['urlServeLambda']. "locations/stores";
          
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
				  CURLOPT_SSLVERSION => 6,
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    "Content-Type: application/x-www-form-urlencoded",
					"Authorization: Bearer asdfaswwwBG",
                ),
            ));

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			$response = curl_exec($curl);
			
			           
			$response = json_decode($response); 
            curl_close($curl);
			
		
		return $this->render('branches',['data'=>$response]);
	}
	   
    public function actionWarehouses() {
				
			$url = Yii::$app->params['urlServeLambda']."locations/index";
          
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $url,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
				  CURLOPT_SSLVERSION => 6,
                CURLOPT_HTTPHEADER => array(
                    "Cache-Control: no-cache",
                    "Content-Type: application/x-www-form-urlencoded",
					"Authorization: Bearer asdfaswwwBG",
                ),
            ));

            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
			$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
			$response = curl_exec($curl);
			
			           
			$response = json_decode($response); 
            curl_close($curl);
			
		
		return $this->render('warehouses',['data'=>$response]);
    }
	
	public function actionSetwarehouse(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$post = Yii::$app->request->post();
		if(isset($post['action'])){
			$model = Warehouses::find()->where(['idApi'=>$post['idApi']])->one();
			$model->delete();
			Yii::$app->response->statusCode = 202;
			return [
				'message'=>'ok'
			];
		}
		
		$model = new Warehouses();
		$model->idShort = $post['idShort'];
		$model->description = $post['description'];
		$model->status = $post['status'];
		$model->idApi = $post['idApi'];
		$model->type = $post['type'];
		$model->society = $post['society'];
		$model->object = '{}';
		
		if($model->save()){
			Yii::$app->response->statusCode = 202;
			return [
				'message'=>'ok'
			];
		}
		return $model->errors;
	}
	
	public function actionSetbranch(){
		\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
		$post = Yii::$app->request->post();
		if(isset($post['action'])){
			$model = Stores::find()->where(['idApi'=>$post['idApi']])->one();
			$model->delete();
			Yii::$app->response->statusCode = 202;
			return [
				'message'=>'ok'
			];
		}
		
		$model = new Stores();
		$model->name = $post['name'];
		$model->status = $post['status'];
		$model->idApi = $post['idApi'];
		$model->warehouseId = $post['warehouseId'];
		$model->objetct = '{}';
		
		if($model->save()){
			Yii::$app->response->statusCode = 202;
			return [
				'message'=>'ok'
			];
		}
		return $model->errors;
	}
}
