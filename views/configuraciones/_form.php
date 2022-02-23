<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\configuraciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="configuraciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::label('Dato'); ?>
    <?= Html::label($model->dato); ?>

    <?= $form->field($model, 'valor')->textInput(); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
