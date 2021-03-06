<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\SignupForm;
use app\models\User;
use app\models\ContactForm;
use app\models\Products;
use app\models\Orders;
use app\models\OrderItems;


class SiteController extends Controller
{
  public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                 'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['logout'],
                        'roles' => ['@'],
                    ],
                ],
              'class' => AccessControl::className(),
                 'only' => ['cart'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//       $user = new User();
//       $tt = User::findByUsername(Yii::$app->user->identity->username);
//       echo $tt->urole."-----";
//           var_dump($user);
        return $this->render('index');
    }
    /**
     * Displays Strode page.
     *
     * @return string
     */
    public function actionStrode()
    {
//       $user = new User();
      
//       $tt = $user->findByUsername(Yii::$app->user->identity->username);
//       $tt->username = "user123";
//       if ($tt->update())
//         return true;
      
//       $user = User::findOne(2);
//       $user->username = "user12";
//       if ($user->update())
//         return true;
      
      return $this->render('strode');
    }
    
      /**
     * SignUp action.
     *
     * @return Response|string
     */
  
    public function actionSignup()
    {
      $model = new SignupForm();
      
      if($model->load(Yii::$app->request->post()) && $model->signup()) {
        return $this->redirect(array('site/login'));
      }
      
      return $this->render('signup',[
            'model' => $model,
        ]);
    }


    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
          $tt = User::findByUsername(Yii::$app->user->identity->username);
          Yii::$app->session['urole'] = $tt->urole;
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }
 

  
   

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
      Yii::$app->user->logout();
      Yii::$app->session->remove('urole');
//       $session->remove('urole');
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
      
        if ( $model->load( Yii::$app->request->post() )  && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
      
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
  
   /**
     * Save product to cart. An show the csrt
     *
     * @return Response
     */
  public function actionCart()
  {

    $session = yii::$app->session;
       $id = $session["cart"];
       $qt = $session["qt"];
    
     if (Yii::$app->request->post('id') !== null && Yii::$app->request->post('id') > 0) {
       if (!is_array($id) && $id !== null) $id[0] = $id; // make array
       
       if ( $id == null || !in_array(Yii::$app->request->post('id'),$id)) // is product is already added
       {
         $id[] = Yii::$app->request->post('id');
         $qt[] = Yii::$app->request->post('quantity');
         $session["cart"] = $id;
         $session["qt"] = $qt;
       }
       else {
         if (!is_array($qt)) $qt[] = $qt; // make array
         $key = array_search(Yii::$app->request->post('id'), $id);

         $qt[$key] = $qt[$key] + Yii::$app->request->post('quantity');
         $session["qt"] = $qt;
       }
       
     }
    $product = Products::findAll($id);
    return $this->render('cart',['modal'=>$product, 'qt'=>$qt]);
  }
  /**
     * Save product to cart. An show the csrt
     *
     * @return Response
     */
  public function actionClearcart()
  {
    // Should be access if you are not guest  (ref. ActionCart)
    // add remove one product only. The action button should be js the same as -+quantity
    // this fuction should be except $_POST["id"] and if isset make a array loop for all ID's and remove the one need to be removed after that remove the same element from quantity array
    // and finish with "
    // $product = Products::findAll($id);
    // return $this->render('cart',['modal'=>$product, 'qt'=>$qt]);
    $session = yii::$app->session;    
    $session->remove("cart");
    $session->remove("qt");
    
    return $this->render('cart');
  }
  
  /**
  * Update quantity in cart and save in session
  *
  * @return Response
  */
  
  public function actionCartaction()
  {
    // Should be access if you are not guest  (ref. ActionCart)
    $session = yii::$app->session;
    
    if (isset($_POST["id"]) && isset($_POST["qt"])) {
      $id = json_decode(($_POST["id"]));
      $qt = json_decode(($_POST["qt"]));
      $qt[1] = 2;
      $session["cart"] = $id;
      $session["qt"] = $qt;  
    } else {
      $id = $session["cart"];
      $qt = $session["qt"];
    }
    
    
    $product = Products::findAll($id);
    return $this->renderPartial('cart',['modal'=>$product, 'qt'=>$qt]);
  }
  
  /**
  * Checkout
  *
  * @return Response
  */
  public function actionCheckout()
  {
    // Should be access if you are not guest  (ref. ActionCart)
    // You should see if $id and $qt are not empty before processing with Orders
    $session = yii::$app->session;
    $id = $session["cart"];
    $qt = $session["qt"];
    $product = Products::findAll($id);

    $orders = new Orders();
    $orders->customer_id = Yii::$app->user->identity->id;
    $orders->order_date = date("Y-m-d");
    $orders->save();
    
    $idorder = $orders->getPrimaryKey(); // Id of last inserted order
    
    
    $order = new OrderItems();
    $i = 0;
    foreach ($id as $pid)
    {
      $product = Products::findOne($pid);
      $order = new OrderItems();
      $order->order_id = $idorder;
      $order->product_id = $pid;
      $order->quantity = $qt[$i];
      $order->unit_price = $product->unit_price;
      $order->save();
      ++$i;
    }

    $session->remove("cart");
    $session->remove("qt");
    

    
    return $this->render('checkout', ['ordernumber'=>$idorder]);
    
  }
  
  
}
