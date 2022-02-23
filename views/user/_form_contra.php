<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use app\models\Rol;
/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
<div class="row">
    <div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>
        
    <div class="form-group field-signupform-password required has-success">
        <label class="control-label" for="signupform-password">Contraseña</label>
        <input type="password" id="signupform-password" class="form-control" name="SignupForm[password]">

        <p class="help-block help-block-error"></p>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
