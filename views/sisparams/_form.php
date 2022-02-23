<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SisParametros */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sis-parametros-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'dato')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'valor')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
