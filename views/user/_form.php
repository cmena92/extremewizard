<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model app\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">
<div class="row">
    <div class="col-lg-6">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'status')->textInput() ?>
    
        <?= $form->field($model, 'status')->dropDownList(
                [1=>'Activado',0=>'Desactivado'],           
                ['prompt'=>'Seleccione por favor']    
        ); ?>
    
     
    <?php // $form->field($model, 'rol_id')->textInput() ?>
        
        <?php
        $roles = app\models\permisos\Rol::find()->all();
        echo $form->field($model, 'rol_id')->dropDownList(
                ArrayHelper::map($roles,'id','nombre'),       
                ['prompt'=>'Seleccione por favor']    
        ); ?>
        
        
        
    <?php // $form->field($model, 'created_at')->textInput() ?>

    <?php // $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <a type="butoon" href="/user/contrasena?id=<?php echo $model->id; ?>" class="btn btn-success">Cambiar Contraseña</a>
    </div>

    <?php ActiveForm::end(); ?>
</div>
</div>
