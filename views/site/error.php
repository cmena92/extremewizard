<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="site-error">

    <h1>Algo ha salido mál</h1>

    <div class="alert alert-danger">
        Esto ocurre cuando el servidor no ha respondido a como se espera.
    </div>

   
    <p class="hidden">
    <?= nl2br(Html::encode($message)) ?>
    </p>

</div>
