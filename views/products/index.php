<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\search\ProductsSearch */
use app\models\Products;
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Productos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12">
			<h1><?= Html::encode($this->title) ?></h1>
		
		<?php Pjax::begin(); ?>
		<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

		
		<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'filterModel' => $searchModel,
			'columns' => [
			   // ['class' => 'yii\grid\SerialColumn'],

				'id',
				'sku:ntext',
				'name:ntext',				
				 [
					'label' => 'Estado',
					'format' => 'raw',
					'value' => function($model) {
						return $model->getStatusString($model->status);
					},
					'contentOptions'=>function($model){
						$class = '';
						if($model->status == Products::STATUS_ACTIVE)
							$class = 'success';
						 return [
							'class' => $class,
						];
					},
					'attribute' => 'status',
					'filter'=>[
						0 => 'Falta Sincronizar',
						1 => 'Sincronizado',
						2 => 'Activo en woocomerce',
						3 => 'Inactivo en woocomerce',
					],
				],
				//(Yii::$app->user->identity->isDevRol)? 'template:ntext':'syncDate',				
				'hasStocks:ntext',				
				[
					'class' => 'yii\grid\ActionColumn',
					'template'=>'{view} {update} {viewinwoo} {editinwoo} {refreshDataFinanzaPro}',
					'contentOptions'=>function($model){
						 return [
							'style' => 'width: 20%;text-align:left',
						];
					},
					'buttons'=>[
						'viewinwoo'=>function ($url,$model) {
							return Html::a('', $model->urlWoo, [
								'class' => 'glyphicon glyphicon-shopping-cart custom_button',
								'title' => 'Ver en woocommerce',
								'target' => '_blank'
								]);
						},
						'editinwoo'=>function ($url, $model) {
							
							$url = Yii::$app->params['urlServeWoo'].'/wp-admin/post.php?post='.$model->idWoo.'&action=edit';
							
							return Html::a('', $url, [
								'class' => 'glyphicon glyphicon-wrench custom_button',
								'title' => 'Editar en woocommerce',
								'target' => '_blank'
								]);
						},
						'refreshDataFinanzaPro'=>function ($url, $model) {
							return Html::a('', '/sync/sku?sku='.$model->sku, [
								'class' => 'glyphicon glyphicon-refresh',
								'title' => 'Refrescar datos desde finanzaProo',
								]);
						},
					],
				],
				],
		]); ?>

		<?php Pjax::end(); ?>
		</div>

	</div>
</div>
