<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm;

use app\models\CatalogModel;
use app\models\AdminModel;
use app\models\AjaxModel; 


//use app\models\SignupForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use app\models\BasketModel;
use app\models\ZakazModel;

class SiteController extends Controller
{
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
                        'actions' => ['logout'],
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
        return $this->render('index');
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
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

	
	
	
	
	public function actionAddadmin() {
    $model = User::find()->where(['username' => 'admin'])->one();
    if (empty($model)) {
        $user = new User();
        $user->username = 'admin';
        $user->email = 'admin@кодер.укр';
        $user->setPassword('admin');
		$user->phone="";
		$user->adress="";
        $user->generateAuthKey();
        if ($user->save()) {
            ///echo 'good';
				
				
			$this->layout = 'ajaxl';
             $modelajax= new AjaxModel;
			 $modelajax->message='good add admin';
				return $this->render('ajaxv', [
                'model' => $modelajax,
			]);
			
        }
		
		
		$this->layout = 'ajaxl';
             $modelajax= new AjaxModel;
			 $modelajax->message='admin is already added';
				return $this->render('ajaxv', [
                'model' => $modelajax,
			]);
			
		
    };
	
	
	
	return  'alex';
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
	
	
 
   
 
    public function actionSignup()
    {
        $model = new SignupForm();
 
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
 
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
 

 

	
	
	
	
	    public function actionRequestpasswordreset()
    {
        $model = new PasswordResetRequestForm();
 
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
 
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
 
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
 
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
 
        return $this->render('resetPassword', [
            'model' => $model,
      ]);
	  }
 

	 public function actionCatalog()
    {
				
		
		if (Yii::$app->request->isGet) {
			
	
			 $model=new CatalogModel();
				
	
			if ($model->load(Yii::$app->request->get()) && $model->validate()) {
			   
						   
			};
			
		   return $this->render('catalog', [
           'model' => $model,
			]);
			
		
	   
		
		};
		
		
        return "second";
    }
	
	
	 public function actionAdminsite()
    {
				
		
		 	 $model=new AdminModel();
			
		   return $this->render('adminsite', [
         'model' => $model,
			]);
			
		
	   
    }
	
	//uploade nim from csv file
	 public function actionUploadenom()
    {
			$this->layout = 'ajaxl';	
		
		 $model_admin=new AdminModel();
		 $model_admin->Uploadenom();
		 
		  $model=new AjaxModel();
		  
		  $model->message=$model_admin->message;
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			
		
	   
    }
	
	
	
	 public function actionMakesection()
    {
			$this->layout = 'ajaxl';	
		
		 $model_admin=new AdminModel();
		 $model_admin->MakeSections();
		 
		  $model=new AjaxModel();
		  
		  $model->message=$model_admin->message;
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			
		
	   
    }
	
	
	
		 public function actionFillidpforsection()
    {
			$this->layout = 'ajaxl';	
		
		     $model_admin=new AdminModel();
		     $model_admin->fillidpInSectionTable();
		 
		  $model=new AjaxModel();
		  
		  $model->message=$model_admin->message;
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			
		
	   
    }
	
	
	
	
	
	 public function actionBasket()
    {
			//$this->layout = 'ajaxl';	
		
		 $model= new BasketModel();	  
		  
			
		   return $this->render('basket', [
         'model' => $model,
			]);
			
		
	   
    }
	
	 public function actionZakaz()
    {
			//$this->layout = 'ajaxl';	
		
		 $model= new ZakazModel();	  
		  
			
		   return $this->render('zakaz', [
         'model' => $model,
			]);
			
		
	   
    }
	
	
	 
	/////clear  cach yii\caching\Cache::flush().
	
	
	
	 public function actionCleancache() 
    {
			$this->layout = 'ajaxl';	
		
		      Yii::$app->cache->flush();
		 
		      $model=new AjaxModel();
		  
		     $model->message="cach is clean";
		  
			
		   return $this->render('ajaxv', [
         'model' => $model,
			]);
			 
		
	   
    }
	
	
	
}
