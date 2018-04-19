<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="admin-default-index">
    <?= Html::a("Просмотреть всех работников", ['/admin/default/all-workers'], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("Я закончил работу", ['operator/close'], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("Работаю с клиентом", ['operator/start-client'], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("Закончил с клиентом", ['operator/stop-client'], ['class' => 'btn btn-lg btn-primary']);?>
</div>
