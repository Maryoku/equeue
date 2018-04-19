<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "WorkTime".
 *
 * @property int $ID
 * @property string $Date
 * @property string $Time_start
 * @property string $Time_stop
 * @property int $Operator_id
 *
 * @property User $operator
 */
class WorkTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'WorkTime';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['Date', 'Time_start', 'Time_stop'], 'safe'],
            [['Operator_id'], 'required'],
            [['Operator_id'], 'integer'],
            [['Operator_id'], 'unique'],
            [['Operator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['Operator_id' => 'id']],
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
            'Time_start' => 'Time Start',
            'Time_stop' => 'Time Stop',
            'Operator_id' => 'Operator ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperator()
    {
        return $this->hasOne(User::className(), ['id' => 'Operator_id']);
    }
}
