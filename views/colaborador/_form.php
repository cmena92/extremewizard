<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Diccionario;
use app\models\Configuraciones; 
use yii\helpers\ArrayHelper;
use dosamigos\datepicker\DatePicker;

?>
<div class="row">
<div class="col-lg-12">
<p><b>NOTA</b> Evite el uso de simbolos especiales como (¨´~).<p>
</div>
	<div class="col-lg-4">
		<div class="colaborador-form">

			<?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'cedula')->textInput([
                'prompt' => '9 digitos',
                'onChange' => 'consultar_cedula()'
            ]) ?>
            
			<?= $form->field($model, 'tipoIdentificacion')->dropDownList(
                        [
                            1=>'Fisica',
                            2=>'Jurídica',
                            3=>'DIMEX',
                            4=>'NITE',
                        ],           
                        [
                            'prompt'=>'Seleccione por favor',
                           //'onChange' => 'cambiarPersona(this)'
                        ]    
                    ); ?>
                    
			<?= $form->field($model, 'nombre')->textInput() ?>

			<?= $form->field($model, 'apellido')->textInput() ?>

			<?= $form->field($model, 'sapellido')->textInput() ?>
            
			<?= $form->field($model, 'nombreCompleto')->textInput() ?>

		</div>
	</div>
	<div class="col-lg-4">
		<div class="colaborador-form">
			

			<?php            
						echo $form->field($model, 'tipo')
						->dropDownList(
							[   
                                1=>'(C) Cliente',
								2=>'(E) Empleado',
								3=>'(I) Inversionista',
								4=>'(P) Proveedor'
                            ],          
								['prompt'=>'Seleccione por favor',
								'onChange'=>'mostrarCodPro(this)' ]    
						); ?>
                        
			<?= $form->field($model, 'cod_provedor')->textInput() ?>
						<?php
					/*echo Html::label('nacimiento');
					echo DatePicker::widget([
						'model' => $model,
						'attribute' => 'nacimiento',
						'language' => 'es', 
						'clientOptions' => [
							'autoclose' => true,
							'format' => 'dd-mm-yyyy'
						]
					]);*/
					?><br>	
                     
                     
                <?php echo $form->field($model, 'correo')->textInput() ?>
                
                <?php 
                    $model->pais = 506;
                     $form->field($model, 'pais')->textInput() ?>
                
                <?php  echo $form->field($model, 'telefono')->textInput([
                                 'type' => 'number']) ?>   
		</div>
	</div>
    <div class="col-lg-4">
		<div class="colaborador-form">
                    
        </div>
	</div>	
    <div class="col-lg-12">
        <div class="form-group">
			<?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
		</div>
    </div>
			
	<?php 
    ActiveForm::end(); ?>

		</div>
	</div>
</div>
<script>
    
</script>
<?php
    if($model->tipo != 4) {         
        $js = "$('.field-colaborador-cod_provedor').addClass('hidden')";  
    }else
        $js ="";
    $this->registerJs($js, yii\web\View::POS_READY); 
    ?>
    
<?php $this->registerJsFile('/js/colaboradores.js'); ?>  
