<?php

namespace app\controllers;

use app\models\Window;
use Yii;
use app\models\Ticket;
use yii\data\ActiveDataProvider;
use yii\base\Component;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TicketController implements the CRUD actions for Ticket model.
 */
class TicketController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    

    public function actionGetTicket()
    {
        $date = date("F j, Y");
        $model = new Ticket();
        $model->Date = $date;
        $model->save($date);

       $this->redirect(['/site/display']);
        return $date;
    }

    public function actionFind()
    {

      $id = Ticket::getTicketNum();
        
        return $id;
    }
    
    
}
