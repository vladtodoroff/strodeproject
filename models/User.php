<?php

namespace app\models;
use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usertable".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $auth_key
 * @property string $access_token
 */

class User extends ActiveRecord implements IdentityInterface
{
  
//   const ROLE_USER = 10;
//   const ROLE_MODERATOR = 20;
//   const ROLE_ADMIN = 30;
  
  // Property
//     public $id;
//     public $username;
//     public $password;
//     public $authKey;
//     public $accessToken;

//     private static $users = [
//         '100' => [
//             'id' => '100',
//             'username' => 'admin',
//             'password' => 'admin',
//             'authKey' => 'test100key',
//             'accessToken' => '100-token',
//         ],
//         '101' => [
//             'id' => '101',
//             'username' => 'demo',
//             'password' => 'demo',
//             'authKey' => 'test101key',
//             'accessToken' => '101-token',
//         ],
//     ];
    
  public static function tableName() 
  {
    return 'usertable';
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
            'auth_key' => 'Auth Key',
            'access_token' => 'Access Token',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
      return self::find()->where(['id'=>$id])->one();
      return self::findOne($id);
//         return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
      return self::find()->where(['access_token'=>$token])->one();
      
//         foreach (self::$users as $user) {
//             if ($user['accessToken'] === $token) {
//                 return new static($user);
//             }
//         }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
      return self::findOne(['username'=>$username]);
//         foreach (self::$users as $user) {
//             if (strcasecmp($user['username'], $username) === 0) {
//                 return new static($user);
//             }
//         }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
//         return $this->password === $password;
     return Yii::$app->security->validatePassword($password,$this->password);
    }
}
