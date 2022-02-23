<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\SisConfiguraciones */

$this->title = 'Create Sis Configuraciones';
$this->params['breadcrumbs'][] = ['label' => 'Sis Configuraciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sis-configuraciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
