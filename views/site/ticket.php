<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'My Yii Application';
?>
<div class="site-ticket">

    <div class="jumbotron">
        <h1>Добро пожаловать!</h1>

        <p class="lead">Нажмите на кнопку, чтобы получить свой электронный талон.</p>

        <p>
            <?= Html::a('Получить билет', ['ticket/get-ticket'], ['class' => 'btn btn-lg btn-success']) ?>
        </p>
    </div>
