<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\user */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			<div class="user-view">	
				<h1><?= Html::encode($this->title) ?></h1>

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

				<?= DetailView::widget([
					'model' => $model,
					'attributes' => [
					//    'id',
						'username',
						//'auth_key',
					   // 'password_hash',
					   // 'password_reset_token',
						'email:email',
						'estado',
						'RolNombre',
						'created_at',
						'updated_at',
					],
				]) ?>

			</div>
		</div>
	</div>
</div>
