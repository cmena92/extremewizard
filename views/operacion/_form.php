<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\permisos\Operacion;

/* @var $this yii\web\View */
/* @var $model app\models\Operacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app','Create') : Yii::t('app','Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>    
    <div class="row">
        <div class="col-lg-3">
        <?php 
        $tipoOperaciones = Operacion::find()->all(); 
        foreach ($tipoOperaciones as $key=>$operacion) { ?>
            <?php if($key%10==0 && $key!=0){?>                
            </div>
            <div class="col-lg-3">
            <?php }?>    
                 <p style="font-size: 22px;"><?= $operacion['nombre']?> </p> 
            
         <?php }?>   
    </div>
    <?php ActiveForm::end(); ?>
</div>
