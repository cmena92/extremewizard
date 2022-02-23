<?php

namespace app\models;

use Yii;

use app\models\Woo;
use app\models\Warehouses;
use app\models\base\CompareWords;
use yii\behaviors\SluggableBehavior;
/**
 * This is the model class for table "wi_products".
 *
 * @property int $id	
 * @property int $idWoo
 * @property string $sku
 * @property string $name
 * @property string $objetct
 * @property string $status
 * @property string|null $syncDate 
 */
class Products extends \yii\db\ActiveRecord
{
	const STATUS_UNSYNC = 0;
    const STATUS_SYNCHR = 1;
    const STATUS_ACTIVE = 2;
    const STATUS_INACTI = 3;
    const STATUS_VISIBL = 4;
	
	public $brand;
	public $taxonomy;
	public $modelWoo;
	public $idParent; //propiedad temporal para crear categoria
	
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wi_products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['sku', 'name', 'objetct', 'status'], 'required'],
			[['sku', 'name','publicName', 'objetct', 'status', 'syncDate','template','urlWoo'], 'string'],
			[['hasStocks'], 'integer'],
			[['hasStocks'], 'default', 'value'=> 0],
            [['sku'], 'unique'], 
        ];
    }

	public function behaviors()
	{
		return [
			[
				'class' => SluggableBehavior::class,
				'attribute' => 'publicName',
			],
		];
	}

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idWoo' => Yii::t('app', 'Id Woo'),
            'id' => Yii::t('app', 'Id'),
            'sku' => Yii::t('app', 'Sku'),
            'name' => Yii::t('app', 'Name'),
            'publicName' => Yii::t('app', 'Public Name'),
            'slug' => Yii::t('app', 'Slug'),
            'objetct' => Yii::t('app', 'Object'),
            'status' => Yii::t('app', 'Status'),
            'syncDate' => Yii::t('app', 'Sync Date'), 
            'btnstatus' => Yii::t('app', 'Status'), 
            'hasStocks' => Yii::t('app', 'Stock'), 
            'idParent' => Yii::t('app', 'Id Parent'), 
            'template' => Yii::t('app', 'Template'), 
        ];
    }
	/*
		Limpia los bodegas vacias o las que no estan activas
	*/
	public function cleanJsonLocations(){
		if($this->objetct !== '{}'){
			$data = json_decode($this->objetct);
			
			foreach($data->stock as $i=>$location){
				if($location->onHand == 0){
					unset($data->stock[$i]);
				}
			}			
			$this->objetct = json_encode((array)$data);
			$this->update();
			return true;
		}
		return false;
		
	}	
	public function getBtnstatus(){
		
		if($this->status <= Products::STATUS_SYNCHR)
			return '<a class="btn btn-success">Activar</a>';
		else
			return $this->getEstado($this->status);
			
	}
	
	public function getBtnver(){
		
		return '<a class="btn btn-info">Consultar</a>';
		
			
	}
	

	
	public static function getStatusString($status){
		$statusString = [
			0=>'Falta Sincronizar',
			1=>'Sincronizado',
			2=>'Activo en woocomerce',
			3=>'Inactivo en woocomerce',
		];
		return $statusString[$status];
	}
	
	public function getTemplate(){
		return 'ADP';
	}
	
	/*
		Organiza el objeto de template que funciona para plantilla de campos, al mismo tiempo la inicializa si no existe
	*/
	public function getLoadTemplate(){
		if($this->template == '')
			$this->template = '{}';
		if($this->objetct == '{}')
			$this->template = '{"brand":[],"taxonomy":[]}';
				
		$data = json_decode($this->template);		
		if(isset($data->brand))
		$this->brand = $data->brand;
	
		if(isset($data->taxonomy))
		$this->taxonomy = $data->taxonomy;
	}
	
	public function sendToWoo(){
		
		$taxonomy_templates = json_decode($this->template);		
		$arrayCategories = [];
		
		foreach($taxonomy_templates->taxonomy as $tax){
			$arrayCategories[] = ['id'=>$tax];				
		}		
		
		$dataApiLambda = json_decode($this->objetct);
		
		
		
		$data = [
			'name' => $this->name,
			'type' => 'simple',
			'regular_price' => $dataApiLambda->priceList[0]->unitPrice.'',
			'sku'=>$this->sku,
			'categories' => $arrayCategories,				
		];
				
		if(!empty($this->slug)){
			$data['slug'] = $this->slug;
		}
		
		if(!empty($this->publicName)){
			$data['name'] = $this->publicName;
		}
		
		$woo = Woo::init();
		$model = $woo->get('products',['sku'=>$this->sku]);
				
		
		if(empty($model)) //crear si no existe
			$model = $woo->post('products', $data);			
		else{
			$id = $model[0]->id;
			$model = $woo->put('products/' . $id, $data);
		}
		
			$this->idWoo = $model->id;
			$this->urlWoo = $model->permalink;		
		return true;
	}
	/*
	Asigna la subCategory de apiLambda del producto por id al objeto de plantilla
	*/
	public function taxNameForId($arrayTax){
		$taxonomys = json_decode($this->objetct);
		$category = [];
		$category[] = $taxonomys->category;
		$category[] = $taxonomys->subCategory;
		$template = '';		
		foreach($category as $taxApiLambda){
			$band = 0;
			foreach($arrayTax as $taxWoo){
				if(CompareWords::c($taxApiLambda,$taxWoo->name)){
					$band = 1;
					if($template == '')
						$template .= '"'.$taxWoo->id.'"';
					else
						$template .= ',"'.$taxWoo->id.'"';					
					break;
				}
			}
			if($band == 0)
				Yii::$app->session->setFlash('warning', 'La taxonomia '. $taxApiLambda .' no existe.');
				
		}
				
		$this->template = '{"taxonomy":['.$template.']}';
	}
	
	public function countStock(){
		$dataApiLambda = json_decode($this->objetct);
		$count = 0;
		foreach($dataApiLambda->stock as $loc){
			if(Warehouses::find()->where(['idApi'=>$loc->warehouseId])->exists()){
				$count += $loc->onHand;
			}
		}
		$this->hasStocks = $count;
	}
	
	public static function callApiLambdaBySku($sku){
		$url = Yii::$app->params['urlServeLambda']."products/view/" . $sku;
		
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
		$productres = curl_exec($curl);
		curl_close($curl);
		
		return $productres;
	}
	
	public static function callApiLambdaByPerPage($pe,$pp){
		$url = Yii::$app->params['urlServeLambda']."products/index?to=".$pp."&page=" . $pe;
		
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
		$response = curl_exec($curl);
		$response = json_decode($response); 
		curl_close($curl);	
		
		return [
			'res'=>$response,
			'code'=>$code
		];
	}
	
	
	public static function callApiLambdaAllForCompare($page,$to){
		$url = Yii::$app->params['urlServeLambda'].'products/index?to='. $to .'&page=' .$page;          
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
		$response = curl_exec($curl);
		$response = json_decode($response); 
		curl_close($curl);	
		
		return [
			'res'=>$response,
			'code'=>$code
		];
	}
	
	public static function callApiLambdaByListSKU($skus){
		$url = Yii::$app->params['urlServeLambda']."products/skus/" . $skus;          
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
		$response = curl_exec($curl);
		$response = json_decode($response); 
		curl_close($curl);	
		
		return $response;
	}
	
}
