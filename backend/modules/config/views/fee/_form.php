<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Fee */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title"><?=  Html::encode($this->title) ?></h3>
    </div>
    <?php $form = ActiveForm::begin(); ?>
    <div class="box-body">
        <div class="row">

            <div class="col-md-12">

                    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
                    <?= \backend\modules\posts\components\CkEditorWidgets::widget(['model'=>$model,'form'=>$form]); ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'fee')->textInput() ?>

    <?= $form->field($model, 'sale')->textInput() ?>

    <?= $form->field($model, 'vat')->textInput() ?>

    <?= $form->field($model, 'class_view')->textInput(['maxlength' => true]) ?>

            </div>

        </div>

    </div>
    <div class="box-footer">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>
