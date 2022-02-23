<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\configuraciones */

$this->title = Yii::t('app', 'Create Configuraciones');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Configuraciones'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="configuraciones-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
