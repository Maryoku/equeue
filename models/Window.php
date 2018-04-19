<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Window".
 *
 * @property int $id
 * @property string $status
 * @property int $operator_id
 * @property int $Work
 *
 * @property Ticket[] $tickets
 * @property User $operator
 */
class Window extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Window';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'string'],
            [['operator_id', 'Work'], 'integer'],
            [['operator_id'], 'unique'],
            [['operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['operator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'status' => 'Status',
            'operator_id' => 'Operator ID',
            'Work' => 'Work',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::className(), ['WindowNum' => 'ID']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(User::className(), ['id' => 'operator_id']);
    }

    public static function getWindowNum()
    {

        if (isset(Window::findOne(['status' => 'open', 'Work' => 0])->id))
        {
            return Window::findOne(['status' => 'open', 'Work' => 0])->id;
        } else
        {
            return null;
        }
    }

    public static function getCloseWindowNum()
    {
        if (isset(Window::findOne(['status' => 'close' ])->id))
        {
            return Window::findOne(['status' => 'close' ])->id;
        } else
        {
            return null;
        }
    }
}
