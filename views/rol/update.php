<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Rol */

$this->title = Yii::t('app','Update').' Rol: ' . ' ' . $model->nombre;
$this->params['breadcrumbs'][] = ['label' => 'Roles', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app','Update');
?>

<div class="products-update">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<h1><?= Html::encode($this->title) ?></h1>

				<?= $this->render('_form', [ 
				'model' => $model, 
				'tipoOperaciones' => $tipoOperaciones 
				]) ?>

			</div>
			</div>
			</div>
