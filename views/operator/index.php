<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model app\models\Operator */
/* @var $form ActiveForm */
$this->title = $win_num.' окно';
$this->registerJsFile('js/OperatorClient.js');
$this->params['breadcrumbs'][] = 'Окно оператора';

?>

<div class="operator-window">
    
    <div id="site-index">

    </div>

    <?php Pjax::begin(); ?>
    <?= Html::a("Я начал работу", ['operator/open'], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("Я закончил работу", ['operator/close'], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("Работаю с клиентом", ['operator/start-client'], ['class' => 'btn btn-lg btn-primary']);?>
    <?= Html::a("Закончил с клиентом", ['operator/stop-client'], ['class' => 'btn btn-lg btn-primary']);?>
    <h1>Вы работаете c <?= $ticket_num ?> талоном </h1>

    <?php Pjax::end(); ?>

</div>
