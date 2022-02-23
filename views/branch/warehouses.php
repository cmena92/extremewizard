<?php

use yii\helpers\Html;
use app\models\sistema\AccessHelpers;
use app\models\Warehouses;


$tam_image = '80px';

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sincronizar localizaciones'), 'url' => ['index']];
$this->title = Yii::t('app', 'Warehouses');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index col-lg-12"> 
    <div class="body-content">
		<h2><?= $this->title ?></h2>
		<table class='table'>
			  <tr>
				<th>Id</th>
				<th>Id Corto</th>
				<th>Descripcion</th>
				<th>Sociedad</th>
				<th>Acciones</th>
			  </tr>
       <?php 
	   
		foreach($data->data as $branch){
			if(!is_null($branch)){
			if(Warehouses::validatePrint($branch->description)){					
			$model = Warehouses::find()->where(['idApi'=>$branch->id])->one();
			
		?>
			
			  <tr class="<?= (is_null($model))?'':'info'?>">
				<td><?= $branch->id ?></td>
				<td><?= $branch->shortId ?></td>
				<td><?= $branch->description ?></td>
				
				<td><?= $branch->society ?></td>
				<td>
				
					<?php
						if(is_null($model)){
							echo Html::a(
							Yii::t('app', 'Activar'),
							'warehouses', 
								[
									'class' => 'btn btn-success',
									'data' => [
										'confirm' => 'Agregar esta bodega visualiza el stock de sus sucursales en el woocommerce'
									],
									'title' => Yii::t('yii', 'Activar'),
									'onclick'=>"
										$.ajax({
											type     :'POST',
											cache    : false,
											data : {
												idShort:".$branch->shortId.",
												idApi:'".$branch->id."',
												description:'".$branch->description."',
												status:1,
												type:'warehouses',
												society:'".$branch->description."',
											},
											url  : 'setwarehouse',
											success  : function(response) {
												
											}
										});",
								]
							);			
								
						}else{
							
								echo Html::a(
								Yii::t('app', 'Desactivar'),
								'warehouses', 
									[
										'title' => Yii::t('yii', 'Desactivar'),
										'onclick'=>"
											$.ajax({
												type     :'POST',
												cache    : false,
												data : {													
													idApi:'".$branch->id."',													
													action:'delete'
												},
												url  : 'setwarehouse',
												success  : function(response) {
													
												}
											});",
										'class' => 'btn btn-danger',
										'data' => [
											'confirm' => 'Quitar esta bodega elimina la visualizacion de sus sucursales en el woocommerce'
										]
									]
								);
							
						}
						
					?>
				</td>
			  </tr>
		<?php			
		}
		}
		}
	   ?>
			</table>
	</div>
</div>