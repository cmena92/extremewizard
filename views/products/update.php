<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Products */

$this->title = Yii::t('app', '{name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="products-update">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1><?= Html::encode($this->title) ?></h1>
			</div>
	   
			
					

			<?= $this->render('_form', [
				'model' => $model,
				'woocategories'=>$woocategories,
				'bracategories'=>$bracategories,
			]) ?>

		</div>
	</div>
</div>
