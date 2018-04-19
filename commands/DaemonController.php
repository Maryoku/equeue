<?php
namespace app\commands;

use Yii;
use yii\console\Controller;
use app\daemons\Daemon;

class DaemonController extends Controller
{
    public function actionStart()
    {
        $daemon = new Daemon();
        $daemon->init();
    }
}