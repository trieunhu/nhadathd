<?php
/* @var $this yii\web\View */
use yii\widgets\ActiveForm;
use yii\helpers\Html;
$this->registerJsFile(Yii::getAlias("@web") . '/themes/bdshd/js' . '/up_images.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<?= \frontend\modules\home\components\member\LeftMemberWidgets::widget() ?>
<div class="col-md-7">
    <div class="postnews">
        <div id="ContentPlaceHolder1_PostNews_pnDangtin">
            <div class="pn-title">
                <h1>THAY ĐỔI THÔNG TIN CÁ NHÂN</h1>
            </div>
            <?php $form = ActiveForm::begin([
            ]); ?>
            <div class="pn-content">
                <?= $form->field($model, 'display_name',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'address',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'facebook',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'skype',['options'=>['class'=>'row'],'template'=>'<div class="col-sm-4">{label}</div><div class="col-sm-8">{input}</div><div class="col-sm-12 col-md-9 col-md-offset-4">{error}</div>'])->textInput(['maxlength' => true]) ?>
                <div class="row field-memberinfo-skype">
                    <div class="col-sm-4">
                        <label class="control-label" for="memberinfo-skype">Hình ảnh</label>
                    </div>
                    <div class="col-sm-8">
                        <div class="row">
                            <div class="col-sm-12 no-padding">
                                <div class="col-sm-4">
                                    <div id="preview" style="<?= !$model->image ? '' : 'display: none;' ?>">
                                        <div class="upload-item no-margin" style="background:url('/uploads/images/avatar-default.png')  no-repeat scroll 0% 0%;">
                                        </div>
                                    </div>
                                    <div id="showimage">
                                        <?php if($model->image){
                                            echo \frontend\modules\home\components\data\GetImageWidgets::widget(['image'=>$model->image]);
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-sm-8 no-padding" style="margin-top: 70px;">
                                    <a  class="btnLogin" id="working-upload-item" style="margin-left: 5px;line-height: 1;">Upload hình ảnh</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9 col-md-offset-4">
                        <div class="help-block"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-8 col-sm-offset-4 submitbds">
                        <div class="row">
                            <div class="col-sm-12">
                                <?= Html::submitButton('Thay đổi', ['class' =>'btnLogin']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<div id="fileupload" style="display: none;">
    <div id="uploadimage" class="clearfix default-theme">
        <form id="uploadForm" action="upload.php" method="post">
            <input id="secleimg" class="fileupload" type="file" name="userImage">
        </form>
    </div>
</div>
<?= \frontend\modules\home\components\member\NoticeMemberWidgets::widget() ?>
