<?php

use yii\helpers\Html;
use app\models\sistema\AccessHelpers;
use app\models\Products;


$tam_image = '80px';


$this->title = Yii::t('app', 'Sincronizar productos');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="site-index"> 

  <div class="container-fluid">
                

				<h2>Resultado</h2>
				<table class='table'>
					  <tr>
						<th>Cont</th>
						<th>Descripcion</th>
						<th>SKU</th>
						<th>Estado</th>
					  </tr>
			   <?php 
				$contador = 0;
				foreach($data as $branch){ 
					if(isset($branch)){
				?>
					<tr>
						<td><?= $contador++ ?></td>
						<td><?= $branch->description ?></td>
						<td><?= $branch->sku ?></td>
						<td><?php
							if($branch->status <= Products::STATUS_SYNCHR)
								echo '<a class="btn btn-success">Activar</a>';
						?></td>
					</tr>
				<?php			
					}
				}
			   ?>
				</table>
				 <?php if(isset($pagination)) { ?>
						<a class='btn btn-info' href='perpage?pp=&pe=<?= $pagination->page+1?>'>Siguiente Pagina</a>
					 <?php }?>
		</div>
</div>
		 
		 
		 
			