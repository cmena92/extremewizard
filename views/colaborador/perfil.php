<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Colaborador */

use app\models\sistema\AccessHelpers; 
use frontend\models\SignupForm;
use yii\widgets\ActiveForm;

$this->title = 'Bienvenido a tu perfil de cliente';

function moneda($pMonto){        
	return  '₡ '.number_format($pMonto, 0, ',', ' ');
}
?>
<div class="colaborador-view">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php 
	 $model = new SignupForm(); 
	$form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    
	
            
	<?= $form->field($model, 'rol_id')->dropDownList(
		 [1=>'Caja',2=>'Admin',3=>'SuperUsuario',5=>'Contador'],          
			['prompt'=>'Seleccione por favor']    
	); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    <a type="butoon" href="/index.php?r=user%2Fcontrasena&id=<?php echo $model->id; ?>" class="btn btn-success">Cambiar Contraseña</a>
    </div>

    <?php ActiveForm::end(); ?>
    
</div>
