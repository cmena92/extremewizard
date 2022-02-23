<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Products;

/* @var $this yii\web\View */
/* @var $model app\models\FieldsTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="fields-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput() ?>

    <?= $form->field($model, 'sku')->textInput() ?>

    <?= $form->field($model, 'template')->textarea(['rows' => 6]) ?>
	
	

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
