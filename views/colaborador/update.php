<?php

use yii\helpers\Html;


$nombre = $model->getNombreCompleto();
$this->title = $nombre;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Colaboradores'), 'url' => ['index','sort'=>'nombre']];
$this->params['breadcrumbs'][] = ['label' => $nombre, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="colaborador-update">

    <h1><?= Html::encode($this->title) ?></h1>

	<?php /* Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) */?>
		
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
