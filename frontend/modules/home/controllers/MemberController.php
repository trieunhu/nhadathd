<?php

namespace frontend\modules\home\controllers;

use common\models\Config;
use frontend\controllers\FrontEndController;
use frontend\modules\home\models\ChangePasswordForm;
use frontend\modules\home\models\MemberFogotPassword;
use frontend\modules\home\models\MemberInfo;
use frontend\modules\home\models\MemberRegister;
use frontend\modules\home\models\LoginForm;
use yii\filters\AccessControl;
use Yii;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\web\Response;
class MemberController extends FrontEndController
{
    public $layout = "@app/views/layouts/main_member";
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'denyCallback' => function($rule, $action) {
                    if (!Yii::$app->user->isGuest){
                        return $this->goHome();
                    }else{
                        return $this->redirect(['login']);
                    }
                },
                'rules' => [
                    [
                        'actions' => ['login', 'register','captcha','fogot-password'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout','index','change-password','change-info'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
    public function actions() {
        return [
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
            ],
        ];
    }
    public function actionChangeInfo()
    {
        $model = MemberInfo::findOne(Yii::$app->user->id);
        if ($model){
            $profile = $model->profile;
            if ($profile){
                $model->skype = $profile->skype;
                $model->facebook = $profile->facebook;
            }
            if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->SaveDB()){
                echo "<script>
			        alert(\"Bạn đã thay đổi thông tin thành công!\");
			  </script>";
            }
            return $this->render('change_info',['model'=>$model]);
        }
        return $this->goHome();
    }
    public function actionChangePassword(){
        $model = new ChangePasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->changepassword()){
            $link = Url::to(['/home/member/index']);
            echo "<script>
			if(confirm(\"Bạn đã thay đổi mật khẩu thành công!. Bạn có muốn về trang chủ không?\")){
			    location.href='".$link."';
			}
			  </script>";
        }

        return $this->render('change_password',['model'=>$model]);
    }
    public function actionFogotPassword(){
        $model = new MemberFogotPassword();
        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            $arrrs = ActiveForm::validate($model);
            $submit = Yii::$app->request->post('submit');
            if (count($arrrs) == 0){
                $arrrs['error'] = 0;
                if (isset($submit) && $submit == 1){
                    Config::sendMail("anhtrieunhu@gmail.com","Mất mật khẩu","123");
                }
            }
            return $arrrs;
        }
    }
    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionLogout(){
        Yii::$app->user->logout();

        return $this->goHome();
    }
    public function actionLogin(){
        $model = new LoginForm();
        $fogot = new MemberFogotPassword();
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->login() ){
            return $this->goHome();
        }
        return $this->render('login',['model'=>$model,'fogot'=>$fogot]);
    }
    public function actionRegister(){
        $model = new MemberRegister();

        if ($model->load(Yii::$app->request->post()) && $model->validate() ){
            $model->save(false);
            return $this->render('register-success',['model'=>$model]);
        }
        return $this->render('register',['model'=>$model]);

    }

}
