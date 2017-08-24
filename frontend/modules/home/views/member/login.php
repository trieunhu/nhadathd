<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;
?>
<div class="col-md-8 col-md-offset-2">
    <div class="postnews">
        <div id="ContentPlaceHolder1_PostNews_pnDangtin">
            <div class="login-title">Đăng nhập</div>
            <div class="pn-content">
                <?php $form = ActiveForm::begin(); ?>
                <?= $form->errorSummary($model) ?>
                <?= $form->field($model, 'username',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'password',['template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->passwordInput(['maxlength' => true]) ?>
                <div class="row">
                    <div class="col-md-8 col-md-offset-4">
                        <div>
                            <?= Html::activeCheckbox($model, 'rememberMe',['label'=>false,'style'=>'margin-right:15px;']); ?>
                            <span>Ghi nhớ mật khẩu</span> | <a  title="Quên mật khẩu" class="a-lost-pass fancybox.ajax" data-toggle="modal" data-target="#myModal" >Quên mật khẩu</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-8">
                        <?= Html::submitButton('Đăng nhập', ['class' =>'btnLogin']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <div class="dangky">
                    Nếu bạn chưa có tài khoản tại nhadathd.vn, vui lòng <a href="<?= Url::to(['/home/member/register']) ?>" title="Đăng ký" class="a-lost-pass">đăng ký tại đây</a>

                </div>
                <div class="modal fade" id="myModal" role="dialog" style="top: 20%;">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Quên mật khẩu</h4>
                            </div>
                            <div class="modal-body">
                                <?php $form = ActiveForm::begin([
                                        'id'=>'form_fogot',
                                        'enableAjaxValidation'=>true,
                                        'action'=>Url::to(['/home/member/fogot-password']),
                                ]); ?>
                                <?= $form->field($fogot, 'label_success',['options'=>['class'=>'no-margin hidden success'],'template'=>'<div class="row"><div class="col-md-4"></div><div class="col-sm-12 col-md-8">{label}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->label('Bạn vui lòng kiểm tra email để đổi mật khẩu') ?>
                                <?= $form->field($fogot, 'email',['options'=>['class'=>'form-group no-margin required'],'template'=>'<div class="row"><div class="col-md-4">{label}</div><div class="col-sm-12 col-md-8">{input}</div><div class="col-sm-12 col-md-8 col-md-offset-4">{error}</div></div>'])->input(['maxlength' => true]) ?>
                                <div class="no-margin hidden loading">
                                    <div class="row">
                                        <div class="col-sm-12 text-center" >
                                            <img src="/uploads/images/loading.gif">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                    </div>
                                    <div class="col-sm-8">
                                        <?= Html::submitButton('Khôi phục mật khẩu', ['class' =>'btnLogin','style'=>'line-height:1;']) ?>
                                    </div>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    Nếu bạn chưa có tài khoản tại nhadathd.vn, vui lòng <a href="<?= Url::to(['/home/member/register']) ?>" title="Đăng ký" class="a-lost-pass">đăng ký tại đây</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
