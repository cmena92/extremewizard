<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Stores */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="stores-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'idApi')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'objetct')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'warehouseId')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
