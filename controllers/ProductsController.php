<?php

namespace app\controllers;

use Yii;
use app\models\Warehouses;
use app\models\Products;
use app\models\search\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Woo;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Products models.
     * @return mixed
     */
    public function actionStock(){
		$products = Products::find()->where(['status'=>2])->all();
		$database = Yii::$app->firebase->getDatabase();
		$reference = $database->getReference('stocks/USB0126');
		$snapshot = $reference->getSnapshot();
		//$value = $snapshot->getValue();
		
		foreach($products as $product){
			$objetFinanza = json_decode($product->objetct); 
			foreach($objetFinanza->stock as $location){
				$warehouse = Warehouses::find()->where(['idApi'=>$location->warehouseId])->one(); 
				$reference = $database->getReference('stocks/' . $product->sku .'/'. $location->warehouseId);
				if(!is_null($warehouse)) {
					$value = $reference->set([
						'description'=>$warehouse->description,
						'onHand'=>$location->onHand,
					]);
				}
			}
			echo $product->sku.' actualizado.';
		}
		
		/*
		$value = $reference->set([
			'description'=>'hola yii2',
			'onHand'=>1,
		]);
		*/
	}
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Products();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		if($model->objetct == '{}')
			return $this->redirect(['/sync/sku', 'sku' => $model->sku]);
		
		$model->cleanJsonLocations();
		$woo = Woo::init();
		$model->countStock();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			if($model->sendToWoo()){
				$model->status = Products::STATUS_ACTIVE.'';
				date_default_timezone_set('America/Costa_Rica');
				$model->syncDate = date('Y-m-d h:i:s a');
				
				$model->countStock();			
							
				if($model->save()){
					return $this->redirect(['view', 'id' => $model->id]);					
				}else{
					return $this->render('errors',['errors' => $model->errors]);
				}
			}else{
				$model->addError('woocomerce', 'No se pudo guardar en woocomerce.');
				return $this->render('errors',['errors' => $model->errors]);
			}
        }
				
		$url = Yii::$app->params['urlServeWoo']."/wp-json/wp/v2/brand_tax?per_page=100";
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
			),
		));

		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
		$brand_tax = curl_exec($curl);
		$brand_tax = json_decode($brand_tax); 
		$taxon_tax = $woo->get('products/categories',['per_page'=>100]);
		$model->getLoadTemplate();
		if($model->template == '{}'){
			$model->taxNameForId($taxon_tax);
			$model->getLoadTemplate();
		}		
						
        return $this->render('update', [
            'model' => $model,
			'woocategories'=>$taxon_tax,
			'bracategories'=>$brand_tax
        ]);
    }

    /**
     * Deletes an existing Products model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		$woo = Woo::init();
		$model = $this->findModel($id);
		$model->status = Products::STATUS_UNSYNC.'';
		$model->objetct = '{}';
		$model->template = '';
		$model->syncDate = null;
		$model->urlWoo = null;
		$idWoo = $model->idWoo;
		$model->idWoo = null;
		$model->hasStocks = null;
		
		
		if($model->save()){
			$model = $woo->get('products',['sku'=>$model->sku]);
			if(!empty($model))
				$woo->delete('products/' . $idWoo, ['force' => true]);
			
		}else{
			var_dump($model->errors);
			die;
		}

        return $this->redirect(['index']);
    }
	
	
    public function actionCreateCat(){
		$woo = Woo::init();
		$data = [
			'name' => $_GET['Products']['name'],
			'parent' => $_GET['Products']['idParent']
		];
		$model = $woo->post('products/categories', $data);
		return $this->redirect(['/products/update','id'=>$_GET['Products']['id']]);
		
	}

    /**
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
