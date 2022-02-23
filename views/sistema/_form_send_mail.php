<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \app\models\base\SendMail */

use yii\helpers\Html;
use yii\widgets\ActiveForm;


    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ]) ?>

        <?= $form->field($model, 'desde')->input('email') ?>
        <?= $form->field($model, 'para')->input('email') ?>
        <?= $form->field($model, 'asunto')->textinput() ?>
        <!--
        <?php $form->field($model, 'mensaje')->textarea() ?>
        -->

        <div class="form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-primary']) ?>            
        </div>
    <?php ActiveForm::end();
