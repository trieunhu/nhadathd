<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\batdongsan\models\Chudautu */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="chudautu-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <div class="col-md-12 no-padding">
        <div class="box box-primary">
            <div class="box-header">
                <?=  $model->isNewRecord ? '':$form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'mo_ta')->textarea(['rows' => 6]) ?>

                <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'website')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                <div class="col-md-4 form-group">
                    <label class="control-label" for="category-title">Ảnh đại diện</label>
                    <?= \backend\modules\posts\components\images\SelectImageWidgets::widget(['model'=>$model]) ?>
                </div>
                <div class="clearfix"></div>
                <?= \backend\modules\batdongsan\components\CreateDiaDiemWidgets::widget(['model'=>$model,'form'=>$form])?>
            </div>
        </div>
    </div>
    <?= backend\modules\posts\components\SeoPostWidgets::widget(['model' => $model, 'form' => $form]); ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?= backend\modules\posts\components\images\UpImageWidgets::widget(); ?>
</div>
