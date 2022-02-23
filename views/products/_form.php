<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\FieldsTemplate;
use app\models\Warehouses;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Products */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin(); ?>

<div class="col-lg-6">
	<?php
		if($model->urlWoo){
			echo Html::label('Enlaces');
			?>
			<ul>
				<li><?php echo Html::a(
					Yii::t('app', 'URL del producto en woocomerce'),
					$model->urlWoo,
					['target'=>'_blank']
					);?>
				</li>
				
				<li><?php
				echo Html::a(
						Yii::t('app', 'Editar el producto en woocomerce'),
						Yii::$app->params['urlServeWoo'] . '/wp-admin/post.php?post='.$model->idWoo.'&action=edit',
						['target'=>'_blank']
					);?>
				</li>
			</ul>
			<?php			
		}
	?>

    <?= $form->field($model, 'sku')->textInput(['readonly' => true]) ?>

    <?= $form->field($model, 'name')->textInput() ?>
	
    <?= $form->field($model, 'publicName')->textInput() ?>
		
	<?php
		echo $form->field($model, 'template')->hiddenInput()->label(false);
		
		echo $form->field($model, 'objetct')->hiddenInput()->label(false);
	?>
		
	<?php		
	
	if($model->hasStocks != 0){
	echo Html::label('Stock').'<br>';
	
		$objetFinanza = json_decode($model->objetct); 
		
		?>
			<div class="table-responsive">
				<table class="table table-bordered">
				<thead>
				  <tr>            
					<th>Bodega</th>
					<th>Tienda</th>
				  </tr>
				</thead>
				<tbody>
				
		<?php foreach($objetFinanza->stock as $location){ ?>
			<?php $warehouse = Warehouses::find()->where(['idApi'=>$location->warehouseId])->one(); 
				if(!is_null($warehouse)) {
			?>			
				  <tr>            
					<td ><?= $warehouse->description  ?></td>
					<td><?= $location->onHand ?></td>
				  </tr>
				<?php } 
			} ?>
				</tbody>
			  </table>
			</div> <?php
		 ?>
        <?php
	}
			echo Html::submitButton(Yii::t('app', 'Save in woocomerce'), [
			'class' => 'btn btn-success',
			'data' => [
				'confirm' => 'Aplicar cambios aca afecta la visualizacion del producto en la pagina web'
				]
			]); 
			
			
			echo Html::a(Yii::t('app', 'Delete from woo'), ['delete', 'id' => $model->id], [
						'class' => 'btn btn-danger',
						'data' => [
							'confirm' => Yii::t('app', 'Desea limpiar SKU y eliminar del woocomerce.'),
							'method' => 'post',
						],
					]);	
			
			?>
  
	
    <?php ActiveForm::end(); ?>
</div>

<div class="col-lg-6">
	
	<div class="col-lg-6" >
		<?php echo Html::label('Categorias'); ?> 
		<div id="jstree_demo_div" >
		
		</div>
		<hr>
		<form action='/products/create-cat' >					
			<label for="newCat">Nueva Categoria</label>
			<input type="text" id="newCat" name ='Products[name]' class="form-control">
			
			 <?php
				$dataCategories = [];
					foreach($woocategories as $cat){
						$dataCategories[$cat->id] = $cat->name;
					}
				echo $form->field($model, 'idParent')->dropDownList(
					$dataCategories,           
					['prompt'=>'Seleccione por favor']    
				); 
				
				echo  $form->field($model, 'id')->hiddenInput()->label(false);
				?>

			 <button type="submit" class="btn btn-default">Enviar</button>			
		</form>
	</div>

	<div class="col-lg-6" >
		<?php 
		echo Html::label('Datos ApiLambda');
			if($model->objetct !== '{}'){
				$dataApiLambda = json_decode($model->objetct);
				$dataApiLambda->hasStocks = $model->hasStocks;
				echo $this->render('view_dataApiLambda', [
					'model' => $dataApiLambda,
				]);

			}
			
		echo Html::a(
				Yii::t('app', 'Refrescar desde FinanzaPro'),
				'/sync/sku?sku='.$model->sku,
				[
					'class' => 'btn btn-info',
				]
				);
		
		?>
	</div>
	
</div>


	
<div class="col-lg-12">
	<?php if(Yii::$app->user->identity->isDevRol){
	
		echo '<br><hr>'.Html::label('Campos para desarrolladores');
		
		echo $form->field($model, 'template')->textInput()->label(false);
		
		echo $form->field($model, 'objetct')->textArea(['rows'=>8])->label(false);
	}
		?>
</div>


	
<!--	
<div class="col-lg-6">
	<div class="panel panel-primary">
		<div class="panel-heading">Estado en woocomerce</div>
		<div class="panel-body">
			<p>No está sincronizado</p>
			<p>Si aplica cambios en este formulario debes volver a sincronizar</p>
			<?php 
				
			?>
		</div>
	</div>
</div>
-->

<link rel="stylesheet" href="/js/jstree/dist/themes/default/style.min.css" />



<?php 
$this->registerJsFile('/js/jstree/dist/jstree.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

if(isset($woocategories)){
	$data = '';
	foreach($woocategories as $cat){
		$data_state = '';
		if(!empty($model->taxonomy)){
			$clave = false;
			$model_taxonomies = json_decode(json_encode($model->taxonomy),true);
			
			$clave = in_array($cat->id, $model_taxonomies);
						
			if($clave){
				$data_state = "'state' : {'opened' : true,'selected' : true},";
			}
		}
		
		if($cat->parent == 0){
			$data .= "{ 'id' : '".$cat->id."', 'parent' : '#','text' : '".$cat->name."',".$data_state."},";
		}else{
			$data .= "{ 'id' : '".$cat->id."','parent' : '".$cat->parent."','text' : '".$cat->name."',".$data_state."},";
		}
			
	}
	
		
	
	$dataB = '';	
	foreach($bracategories as $brand){
		$data_state = '';
		
		if(isset($model->brand)){
			$clave = false;
			$model_brand = json_decode(json_encode($model->brand),true);	
			$clave = in_array($brand->id, $model_brand);
			
			if($clave)
			$data_state = "'state' : {'opened' : true,'selected' : true},";
		}		
		
		if($brand->parent == 0)
			$dataB .= "{ 'id' : '".$brand->id."', 'parent' : '#', 'text' : '".$brand->name."',".$data_state."},";
		else
			$dataB .= "{'id' : '".$brand->id."','parent' : '".$brand->parent."','text' : '".$brand->name."',".$data_state."},";
			
	}

}
?>
<script>
		var dataJsComponente = [<?= $data ?>]
		var dataJsComponenteBr = [<?= $dataB ?>]
		
	</script>
<?php

	$this->registerJsFile(
		'@web/js/category.js',
		['depends' => [\yii\web\JqueryAsset::class]]
	);