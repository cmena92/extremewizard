<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\user */

$this->title = 'Nueva contraseña para : ' . $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12">

			<h1><?= Html::encode($this->title) ?></h1>
			
			<?= $this->render('_form_contra', [
				'model' => $model,
			]) ?>

		</div>
		</div>
		</div>
