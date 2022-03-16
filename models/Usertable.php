<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usertable".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property int $urole
 * @property string $auth_key
 * @property string $access_token
 */
class Usertable extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usertable';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'auth_key', 'access_token'], 'required'],
            [['urole'], 'integer'],
            [['username'], 'string', 'max' => 55],
            [['password', 'auth_key', 'access_token'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'urole' => 'Urole',
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }
  
  
}
