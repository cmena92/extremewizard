<?php

use yii\helpers\Html;

$this->title = 'Sistema';
$this->params['breadcrumbs'][] = 'Sistema';
?>
<div class="sis-configuraciones-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
