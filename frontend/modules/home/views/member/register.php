<?php
use yii\widgets\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/js');
$this->registerJsFile($url.'/jquery.nice-select.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url.'/moment-with-locales.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url.'/bootstrap-datetimepicker.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile($url.'/customInput.jquery.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
list(, $url) = Yii::$app->assetManager->publish(Yii::getAlias("@webroot") . '/themes/bdshd/css');
$this->registerCssFile($url . '/nice-select.css');
$this->registerCssFile($url . '/bootstrap-datetimepicker.css');
?>
<div class="col-md-8 col-md-offset-2">
    <div class="postnews">
        <div id="ContentPlaceHolder1_PostNews_pnDangtin">
            <div class="pn-title">
                <h1>Đăng ký</h1>
            </div>
            <div class="pn-content">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->errorSummary($model) ?>
                <p>Mời Quý vị đăng ký thành viên để được hưởng nhiều lợi ích và hỗ trợ từ chúng tôi!</p>
                <h4 class="posth4">THÔNG TIN CƠ BẢN</h4>
                <?= $form->field($model, 'display_name',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'username',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password_repeat',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->passwordInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'email',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'mobile',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->textInput(['maxlength' => true]) ?>
                <?php echo $form->field($model, 'verifyCode',['template' => '<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->widget(Captcha::className(), [ 'captchaAction' => '/home/member/captcha','template'=>'<div class="row"><div class="col-sm-8">{input}</div><div class="col-sm-4 no-padding">{image}</div></div>', 'options' => [ 'class' => 'form-control']]); ?>
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-8">
                        <?= Html::submitButton('Đăng ký', ['class' =>'btnLogin']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>