<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;

use frontend\models\ApisSearchForm;
//use frontend\components\Calculators;
/**
 * Site controller
 */
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
                'only' => ['logout', 'signup', 'index'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout', 'index', 'apis', 'results', 'reports', 'reportresults'],
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
    
    public function actionReports($slug, $param_id){        
        return $this->render('reports', ['query'=>$slug, 'param_id'=>$param_id]);
    }
    
    public function actionReportresults(){
        $slug = $_REQUEST['query'];
        
        //var_dump($_REQUEST);
        //exit;
        if($_REQUEST['report_type']=='standard'){        
            return $this->renderPartial('report_results');
            }else{
                return $this->renderPartial('reports/'.$slug);
            }
    }
    
/*
   	public function actionApis()
	{
        ini_set('max_execution_time', 150000);
        ini_set("memory_limit","520M");
        
        //?key=&secret=&scope=full
        $url = 'https://building.dev.boothbook.com/api/v1/get/event_types';
        $params = [
          'key' 	=> '1Eu3NZahxCdfgSHDGMPsUqBOkKf5nzco7AyI4mr6Tt0.boothbook.api.v1',
          'secret' 	=> 'BBfHX0dZCytSjGqBkAUYgE',
        ];
        
		$aa = Calculators::curlcall($url, $params);
        var_dump($aa);
	} 
    
   	
    public function actionDashboardview()
	{
       $id = $_REQUEST['id'];
	   $this->renderPartial('view_results', ['model'=>$this->loadModel($id)]);
	}
*/   

    
    

    /**
     * Displays homepage.
     *
     * @return mixed
     */
     /*
    public function actionIndex()
    {
        $form_model = new ApisSearchForm();
        return $this->render('index', ['form_model' => $form_model]);
    }
    
   	public function actionResults()
	{
        $model = new ApisSearchForm();
 	  if($model->load(Yii::$app->request->post())){
 	     $params = ['key' => $model->key, 'secret' => $model->secret, 'scope' => $model->scope]; 
          
        $event_types_url = 'https://building.dev.boothbook.com/api/v1/get/event_types';
        
        
		$event_types = Self::curlcall($event_types_url, $params);
          
          
          
          
            $this->renderPartial('report_results', ['model' => $model, 'event_types' => $event_types]); 
        }else{
            echo 'Some error';
        }
	}
   
    
    public static function curlcall($url, $params)
    {     
        $ch = curl_init($url); //.'/api/v1/get/bookings'
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        //$result = json_decode(curl_exec($ch));
        if(curl_errno($ch) || !$result){echo 'Error:' . curl_error($ch); curl_close ($ch);}else{ curl_close ($ch); return $result; }      
    }
 */
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            
            /*
            $cookies = Yii::$app->response->cookies;  
  
            // add a new cookie to the response to be sent  
            $cookies->add(new \yii\web\Cookie([  
                'name' => 'email',  
                'value' => $model->email, 
                'expire' => time() + 86400 * 365, 
            ]));  
            */
            
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', ['model' => $model]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', ['model' => $model]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
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
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
}