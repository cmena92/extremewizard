<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

use app\models\Rol;

$this->title = Yii::t('app', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12">
			<h1><?= Html::encode($this->title) ?></h1>

			<div class="row">
				<div class="col-lg-5">
					<?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

						<?= $form->field($model, 'username') ?>
					
					 <?php
					$roles = app\models\permisos\Rol::find()->all();
					echo $form->field($model, 'rol')->dropDownList(
							ArrayHelper::map($roles,'id','nombre'),       
							['prompt'=>'Seleccione por favor']    
					); ?>
				
						<?= $form->field($model, 'email') ?>

						<?= $form->field($model, 'password')->passwordInput() ?>
					
						 
						<div class="form-group">
							<?= Html::submitButton('Crear', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
						</div>

					<?php ActiveForm::end(); ?>
				</div>
			</div>
		</div>
	</div>
</div>
