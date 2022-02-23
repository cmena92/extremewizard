<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'Accceso no permitido';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid">
	<div class="row">

		<div class="col-lg-12">
		
			<h1><?= Html::encode($this->title) ?></h1>

			<div class="alert alert-danger">
			<p>No tiene permiso para acceder a esta página.</p>
			<h2>Zona restringida por seguridad</h2>
			<p>La operacion [  <?php echo $operacion; ?>  ] fue rechazada, solicite permisos al administrador.</p>
			</div>
		</div>
	</div>
</div>
