<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12">
				<h1><?= Html::encode($this->title) ?></h1>
			</div>
	   <div class="col-lg-12">
		
			<div class="col-lg-6">
				<p>
					<?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
					<?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
							'method' => 'post',
						],
					]) ?>
				</p>
				
				<?php
		if($model->urlWoo){
			echo Html::label('Enlaces');
			?>
			<ul>
				<li><?php echo Html::a(
					Yii::t('app', 'URL del producto en woocomerce'),
					$model->urlWoo,
					['target'=>'_blank']
					);?>
				</li>
				
				<li><?php
				echo Html::a(
						Yii::t('app', 'Editar el producto en woocomerce'),
						Yii::$app->params['urlServeWoo'] . '/wp-admin/post.php?post='.$model->idWoo.'&action=edit',
						['target'=>'_blank']
					);?>
				</li>
			</ul>
			<?php			
		}
	?>
	
				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
						'id',
						'sku:ntext',
						'name:ntext',						
						'publicName:ntext',						
						'slug:ntext',						
						'status:ntext',						
						'syncDate:ntext',
						'idWoo:ntext',
						'urlWoo:ntext',
						'hasStocks:ntext',
					],
				]) ?>
				
				<?php 
				if(Yii::$app->user->identity->isDevRol){ ?>
					</div>
					<div class="col-lg-6"><?php
					echo Html::label('Campos para desarrolladores');
				
					echo DetailView::widget([
						'model' => $model,
						'attributes' => [												
							'objetct:ntext',
							'status:ntext',
							'syncDate:ntext',
							'template:ntext',
						],
					]);
				}
				?>

			</div>
		</div>
	</div>
</div>
