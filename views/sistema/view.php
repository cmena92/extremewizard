<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SisConfiguraciones */

$this->title = $model->Persona;
$this->params['breadcrumbs'][] = ['label' => 'Sis Configuraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sis-configuraciones-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->Persona], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->Persona], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'NombreComercial:ntext',
            'Cedula:ntext',
            'Persona',
            'Provincia',
            'Canton',
            'Distrito',
            'Barrio',
            'OtrasSenas:ntext',
            'UsuarioDGT:ntext',
            'ClaveDGT:ntext',
            'ArchivoP12:ntext',
            'MostrarSloganEnFactura',
            'ClientePorDefecto',
            'Telefono:ntext',
            'Correo:ntext',
            'Ambiente',
            'Fax:ntext',
            'GrupoDeActivos:ntext',
            'NombreDeLotes:ntext',
            'Logo:ntext',
            'Inventario',
        ],
    ]) ?>

</div>
