
<?php

use yii\helpers\Html;
use app\models\sistema\AccessHelpers;
use app\models\Warehouses;
use app\models\Stores;


$tam_image = '80px';


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sincronizar localizaciones'), 'url' => ['index']];
$this->title = Yii::t('app', 'Sucursales');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="col-lg-12"> 
    <div class="body-content">
		<h2>Stores</h2>
		<table class='table'>
			  <tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Tipo</th>
				<th>IdAlmacen</th>
				<th>Accion</th>
			  </tr>
       <?php 
	   
		foreach($data->data as $branch){ 
			$modelWare = Warehouses::find()->where(['idApi'=>$branch->warehouseId])->one();
			$model = Stores::find()->where(['idApi'=>$branch->id])->one();
			
			
		?>
			
			  <tr class="<?= (isset($model))?'success':'' ?>">
				<td><?= $branch->id ?></td>
				<td><?= $branch->name ?></td>
				<td><?= $branch->object ?></td>
				<td><?= $branch->warehouseId ?></td>
				<td>
				<?php
				if(is_null($model)){
							echo Html::a(
							Yii::t('app', 'Activar'),
							'branches', 
								[
									'class' => 'btn btn-success',
									
									'title' => Yii::t('yii', 'Activar'),
									'onclick'=>"
										$.ajax({
											type     :'POST',
											cache    : false,
											data : {
												idApi:'".$branch->id."',
												name:'".$branch->name."',
												warehouseId:'".$branch->warehouseId."',
												status:1,
												type:'".$branch->object."',
											},
											url  : 'setbranch',
											success  : function(response) {
												
											}
										});",
								]
							);			
								
						}else{
							
								echo Html::a(
								Yii::t('app', 'Desactivar'),
								'branches', 
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
												url  : 'setbranch',
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
	   ?>
			</table>
	</div>
</div>