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
		<div class="row">
			<div  class="col-xs-6 col-sm-6 col-md-6">							
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Por pagina</h3>
				  </div>
				  <div class="panel-body">
					<div style="text-align: center;" class="col-sm-12">
						<p><?php echo Html::img('/img/servicios/bach.png', ['height' => '' . $tam_image]) ?></p>
					</div>
							
					<form action='/sync/perpage'>
					
					<label for="inputPerPage">Cantidad por pagina</label>
					<input type="text" id="inputPerPage" name ='pp' class="form-control" aria-describedby="helpBlock">
					<span id="helpBlock" class="help-block">Por defecto es de 1500 elementos por pagina iniciando desde la 0.</span>

					<label for="inputPage">Pagina numero</label>
					<input type="text" id="inputPage" name ='pe' class="form-control" aria-describedby="helpBlock">
					<span id="helpBlock" class="help-block">Por defecto 0.</span>


					 <button type="submit" class="btn btn-default">Enviar</button>
					 <?php if(isset($pagination)) { ?>
						<a class='btn btn-info' href='perpage?pp=&pe=<?= $pagination->page+1?>'>Siguiente Pagina</a>
					 <?php }?>
					 
					</form>
				  </div>
				</div>
			</div>
			
			<div  class="col-xs-6 col-sm-6 col-md-6">							
				<div class="panel panel-default">
				  <div class="panel-heading">
					<h3 class="panel-title">Por sku</h3>
				  </div>
				  <div class="panel-body">
					<div style="text-align: center;" class="col-sm-12">
						<p><?php echo Html::img('/img/servicios/sku.png', ['height' => '' . $tam_image]) ?></p>    
					</div>
							
					<form action='/sync/sku'>
							
							
							<label for="inputPage">SKU</label>
							<input type="text" id="inputPage" name ='sku' class="form-control" aria-describedby="helpBlock">
							
							<br>
							 <button type="submit" class="btn btn-default">Enviar</button>
							</form>
				  </div>
				</div>
			</div>
			
		</div>
						
</div>