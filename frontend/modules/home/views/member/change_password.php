<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<?= \frontend\modules\home\components\member\LeftMemberWidgets::widget() ?>
    <div class="col-md-7">
        <div class="postnews">
            <div id="ContentPlaceHolder1_PostNews_pnDangtin">
                <div class="pn-title">
                    <h1>THAY ĐỔI MẬT KHẨU</h1>
                </div>
                <?php $form = ActiveForm::begin([
                ]); ?>
                <div class="pn-content">
                    <?= $form->field($model, 'password_old',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'password',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'password_repeat',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->passwordInput(['maxlength' => true]) ?>
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-4 submitbds">
                            <div class="row">
                                <div class="col-sm-4">
                                    <?= Html::submitButton('Thay đổi', ['class' =>'btnpost btn']) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
<?= \frontend\modules\home\components\member\NoticeMemberWidgets::widget() ?>
