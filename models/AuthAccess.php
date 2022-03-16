<?php

namespace app\models;
use Yii;
use yii\web\ForbiddenHttpException;

class AuthAccess {
  
  public function checkAdmin() 
  {
    if (Yii::$app->session["urole"] > 11) 
    {
      throw new ForbiddenHttpException("You don't have permision to access this page");
    }
  }
  
  public function checkRole($role)
  {
    $role = strtolower($role);
    switch($role)
      {
      case 'admin':
        if (Yii::$app->session['urole'] < 11) return true;
        return false;
        break;
      case 'sales':
        if (Yii::$app->session['urole'] < 21) return true;
        return false;
        break;
      case 'user':
        if (Yii::$app->session['urole'] < 101) return true;
        return false;
        break;
    }
  }
  
  
}