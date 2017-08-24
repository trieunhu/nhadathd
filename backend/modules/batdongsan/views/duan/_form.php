<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;

$this->registerCssFile(Yii::getAlias("@web") . '/css/jquery.tag-editor.css');

$this->registerJsFile('https://code.jquery.com/ui/1.10.2/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
//$this->registerJsFile(Yii::getAlias("@web") . '/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/js/jquery.caret.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/js/jquery.tag-editor.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="duan-form">
    <?php $form = ActiveForm::begin(); ?>
        <?= $form->errorSummary($model); ?>
    <div class="col-md-8">
        <div class="box box-primary">
            <div class="box-header">


                <?=  $model->isNewRecord ? '':$form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

                  <?=
                    $form->field($model, 'mo_ta')->widget(CKEditor::className(), [
                        'editorOptions' => [
                            'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                            'inline' => false, //по умолчанию false
                        ],
                    ]);
                    ?>

                <?= $form->field($model, 'dien_tich')->textInput(['maxlength' => true]) ?>

                <?=  $form->field($model, 'chudautu_id')
                            ->dropDownList(
                                    ArrayHelper::map(\backend\modules\batdongsan\models\Chudautu::find()->all(), "id", "ten"), ["class" => "form-control chudautu_id", 'id' => "chudautu_id", "prompt" => "Chủ đầu tư"]
                            )?>
                <?= \backend\modules\batdongsan\components\CreateDiaDiemWidgets::widget(['model'=>$model,'form'=>$form])?>

            </div>
        </div>
        <?= backend\modules\posts\components\SeoPostWidgets::widget(['model' => $model, 'form' => $form]); ?>
    </div>
    <?= backend\modules\posts\components\CreatePostWidgets::widget(['model' => $model, 'form' => $form]); ?>
    <?= backend\modules\posts\components\CategoryPostWidgets::widget(['model' => $model]); ?>
    <?= backend\modules\posts\components\TagsPostWidgets::widget(['model' => $model]); ?>
    <?= backend\modules\posts\components\images\FileUpImageWidgets::widget(['model' => $model,'title'=>'Ảnh đại diện']); ?>

    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
    <?= backend\modules\posts\components\images\UpImageWidgets::widget(); ?>
</div>
<script>
        $(document).ready(function () {
           $('#chudautu_id').select2(); 
        });
</script>