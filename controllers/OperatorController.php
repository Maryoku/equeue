<?php

namespace app\controllers;

use app\models\Ticket;
use app\models\User;
use app\models\UserIdentity;
use app\models\WorkTime;
use Yii;
use app\models\Window;
use yii\web\Controller;

/**
 * Created by PhpStorm.
 * User: root
 * Date: 28.03.18
 * Time: 17:41
 */
class OperatorController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index',
            ['ticket_num'=> 0, 'win_num' => null]);
    }

    public function actionOpen()
    {
        $window_num = Window::getCloseWindowNum();
        $window = Window::findOne($window_num);

        if ($window != null)
        {
            $window->status = 'open';
            $window->operator_id = Yii::$app->user->id;
            $window->Work = 0;
            $window->save();

            $work = new WorkTime();
            $values = [
                'Date' => date("F j, Y"),
                'Time_start' => date('g:i a'),
                'Operator_id' => Yii::$app->user->id,
            ];
            $work->attributes = $values;            
            $work->save();

            return $this->render('index',
                ['ticket_num'=>0, 'win_num' => $window->id ]);
        } else {
            return $this->render('index',
                ['ticket_num'=>0, 'win_num' => null ]);
        }

    }

    public function actionClose()
    {
        $window = Window::findOne(['operator_id'=>Yii::$app->user->id]);

        if ($window != null)
        {
            $window->status = 'close';
            $window->operator_id = null;
            $window->save();

            $work = WorkTime::findOne(['Operator_id'=>Yii::$app->user->id, 'Time_stop' => null]);
            $work->Time_stop = date('g:i a');
            $work->save();
            return $this->render('index',
                ['ticket_num'=>0, 'win_num' => $window->id ]);
        } else {
            return $this->render('index',
                ['ticket_num'=>0, 'win_num' =>0 ]);
        }
    }

    public function actionStartClient()
    {
        $window = Window::findOne(['operator_id'=>Yii::$app->user->id]);
        $ticket = Ticket::findOne(['WindowNum' => $window->id, 'time_stop' => null]);
        $ticket->operator_id = Yii::$app->user->id;
        $ticket->save();
        $window->Work = 1;
        $window->save();
        return $this->render('index',
            ['ticket_num'=>$ticket->ID,  'win_num' => $window->id]);

    }

    public function actionStopClient()
    {
        $window = Window::findOne(['operator_id'=>Yii::$app->user->id]);
        $ticket = Ticket::findOne(['WindowNum' => $window->id, 'time_stop' => null]);
        $ticket->time_stop = date('g:i a');
        $ticket->save();
        $window->Work = 0;
        $window->save();
        return $this->render('index',
            ['ticket_num'=>$ticket->ID,  'win_num' => $window->id]);

    }



} 