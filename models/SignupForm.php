<?php

namespace app\models;

use Yii;
use yii\base\Model;


/**
 * SignUpForm is the model behind the SignUp form.
 *
 * @property-read User|null $user
 *
 */
  
class SignupForm extends Model 
{
  
  public $username;
  public $password;
  public $password_repeat;
  
  
  public function rules()
  {
    return [
      [['username','password','password_repeat'],'required'],
      [['username'],'string','min'=>5,'max'=>55],
      [['password','password_repeat'],'string','min'=>8,'max'=>55],
      [['password_repeat'],'compare','compareAttribute'=>'password']
    ];
    
  }
  public function signup()
  {
    $user = new User();
    
    if (!$user->findByUsername($this->username)) {
    
    $user->username = $this->username;
    $user->password = Yii::$app->security->generatePasswordHash($this->password);
//     $user->password = $this->password;
    $user->access_token = Yii::$app->security->generateRandomString();
    $user->auth_key = Yii::$app->security->generateRandomString();
    
    if ($user->save())
      return true;
    } 
    Yii::error( "User was not saved.");
    return false;
  }
  
  
  //     $user->password = Yii::$app->security->generatePasswordHash($this->password);
  
}