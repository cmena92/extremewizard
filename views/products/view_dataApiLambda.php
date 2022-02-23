<?php 
use app\models\Warehouses;

?>
<ul>
	<li><b>Category:</b>  <?= $model->category ?></li>
	<li><b>SubCategory:</b> <?= $model->subCategory ?></li>
	<li><b>SKU:</b> <?= $model->sku ?></li>
	<li><b>Price:</b> <?= $model->priceList[0]->unitPrice.' '.$model->priceList[0]->currency ?></li>
	<li><b>Stock:</b> <?= $model->hasStocks ?> </li>
</ul>