<?php

use yii\helpers\Html;
use app\models\sistema\AccessHelpers;
use app\models\Products;


$tam_image = '80px';


$this->title = Yii::t('app', 'Sincronizar localizaciones');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index"> 
	<div class="container-fluid">
		<div class="row">
			<div  class="col-xs-6 col-sm-6 col-md-6">							
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Sucursales</h3>
				  </div>
				  <div class="panel-body">
					<div style="text-align: center;" class="col-sm-12">
						<p><?php echo Html::img('/img/servicios/bach.png', ['height' => '' . $tam_image]) ?></p>
					</div>
					
					<?php
						echo Html::a(
							Yii::t('app', 'Sucursales'),
							'branches', 
								[
									'class' => 'btn btn-success',									
								]
							);			
						
					?>
					
				  </div>
				</div>
			</div>
			
			<div  class="col-xs-6 col-sm-6 col-md-6">							
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Bodegas</h3>
				  </div>
				  <div class="panel-body">
					<div style="text-align: center;" class="col-sm-12">
						<p><?php echo Html::img('/img/servicios/sku.png', ['height' => '' . $tam_image]) ?></p>    
					</div>
					<?php
						echo Html::a(
							Yii::t('app', 'Bodegas'),
							'warehouses', 
								[
									'class' => 'btn btn-success',									
								]
							);			
						
					?>
				  </div>
				</div>
			</div>
			
		</div>
						
</div>