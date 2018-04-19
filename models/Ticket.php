<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ticket".
 *
 * @property int $ID
 * @property string $Date
 * @property int $WindowNum
 * @property string $time_start
 * @property string $time_stop
 * @property int $operator_id
 *
 * @property Window $windowNum
 */
class Ticket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['WindowNum', 'operator_id'], 'integer'],
            [['time_start', 'time_stop'], 'safe'],
            [['Date'], 'string', 'max' => 30],
            [['WindowNum'], 'exist', 'skipOnError' => true, 'targetClass' => Window::className(), 'targetAttribute' => ['WindowNum' => 'ID']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Date' => 'Date',
            'WindowNum' => 'Window Num',
            'time_start' => 'Time Start',
            'time_stop' => 'Time Stop',
            'operator_id' => 'Operator ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWindowNum()
    {
        return $this->hasOne(Window::className(), ['ID' => 'WindowNum']);
    }

    public static function getTicketNum()
    {
        if (isset(Ticket::findOne(['WindowNum' => null ])->ID))
        {
            return Ticket::findOne(['WindowNum' => null ])->ID;
        } else
        {
            return null;
        }
    }
    
    public static function getLastRows()
    {
        $rows = (new \yii\db\Query())
            ->select(['id', 'date', 'windownum', 'time_start', 'time_stop' ])
            ->from('Ticket')
            ->where(['WindowNum' => [1,2,3,4,5] ])
            ->orderBy('id DESC')
            ->limit(5)
            ->all();
        
         return $rows;
    }
}
