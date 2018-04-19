<?php

namespace app\modules\admin\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property int $status
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 * @property string $role
 *
 * @property Window $window
 * @property WorkTime $workTime
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['status'], 'integer'],
            [['role'], 'string'],
            [['username'], 'string', 'max' => 255],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'status' => 'Status',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
            'role' => 'Role',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWindow()
    {
        return $this->hasOne(Window::className(), ['operator_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkTime()
    {
        return $this->hasOne(WorkTime::className(), ['Operator_id' => 'id']);
    }
}
