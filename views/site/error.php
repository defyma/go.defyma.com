<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="hero">
    <h1 class="hero__title"><?= Html::encode($this->title) ?></h1>
    <p class="hero__description"><?= nl2br(Html::encode($message)) ?></p>
</div>
