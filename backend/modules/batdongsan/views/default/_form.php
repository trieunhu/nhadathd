<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use mihaildev\ckeditor\CKEditor;
use backend\modules\config\models\Trangthai;

$this->registerCssFile(Yii::getAlias("@web") . '/css/jquery.tag-editor.css');
$this->registerJsFile(Yii::getAlias("@web") . '/js/jquery-ui.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/js/jquery.caret.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/js/jquery.tag-editor.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/js/macKeys.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile(Yii::getAlias("@web") . '/js/form.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>
<div class="batdongsan-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->errorSummary($model); ?>
    <div class="row">
        <div class="col-md-8">
            <div class="box box-primary">
                <div class="box-header">

                    <div class="col-md-12 row">
                        <h1>Thông tin cơ bản</h1>
                        <div class="col-md-8 form-group">
                            <div class="col-md-4"><p>Hợp đồng:</p></div>
                            <div class="col-md-8">
                                <?= Html::activeDropDownList($model, "hopdong_id", ArrayHelper::map(Trangthai::find()->where(['type' => 'hopdong'])->all(), "id", "ten"), ["class" => "form-control", "prompt" => "Chọn loại hợp đồng"]) ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>
                        <?= \backend\modules\batdongsan\components\CreateDiaDiemWidgets::widget(['model' => $model, 'form' => $form]) ?>
                    </div>
                    <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>
                    <div class="row">
                        <h1 class="col-md-12"> Thông tin cơ bản</h1>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'donvi_id')
                                        ->dropDownList(
                                            ArrayHelper::map(Trangthai::find()->where(['type' => 'donvi'])->all(), "id", "ten"), ["class" => "form-control donvi_id", 'id' => "donvi_id", "prompt" => "Đơn vị giá"]
                                        )
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'gia')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <?= $form->field($model, 'mat_tien')->textInput(['maxlength' => true]) ?>
                                </div>

                                <div class="col-md-3 no-padding">
                                    <?= $form->field($model, 'duong_truoc_nha')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <?=
                                    $form->field($model, 'huong_id')
                                        ->dropDownList(ArrayHelper::map(Trangthai::find()->where(['type' => 'huong'])->all(), "id", "ten"), ["class" => "form-control", "prompt" => "Chọn hướng"]
                                        )
                                    ?>
                                </div>
                                <div class="col-md-4">
                                    <?= $form->field($model, 'dien_tich')->textInput(['maxlength' => true]) ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="width: 100%; color: black; height: 1px; background-color:black;"/>
                    <div class="clearfix"></div>
                    <div class="col-md-12 row">
                        <h1>Mô tả chi tiết</h1>
                        <?= $model->isNewRecord ? '' : $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
                        <?= $form->field($model, 'ten')->textInput(['maxlength' => true]) ?>

                        <?= \backend\modules\posts\components\CkEditorWidgets::widget(['model' => $model, 'form' => $form]); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($model, 'ngay_hien_thi')->textInput() ?>
                    </div>
                    <div class="col-md-6">

                        <?= $form->field($model, 'ngay_het_han')->textInput() ?>
                    </div>
                </div>
            </div>
            <?= backend\modules\posts\components\SeoPostWidgets::widget(['model' => $model, 'form' => $form]); ?>
        </div>
        <?= backend\modules\posts\components\CreatePostWidgets::widget(['model' => $model, 'form' => $form]); ?>
        <!-- /.box -->

        <?= backend\modules\posts\components\CategoryPostWidgets::widget(['model' => $model, 'type' => 'batdongsan']); ?>
        <?= backend\modules\posts\components\TagsPostWidgets::widget(['model' => $model]); ?>
        <?= backend\modules\posts\components\images\FileUpImageWidgets::widget(['model' => $model, 'title' => 'Ảnh đại diện']); ?>
        <?= backend\modules\posts\components\images\FileUpImageWidgets::widget(['model' => $model, 'title' => "Ảnh trình chiếu", 'type' => 'slider']); ?>
    </div>
    <div class="clearfix"></div>
    <?php ActiveForm::end(); ?>
    <?= backend\modules\posts\components\images\UpImageWidgets::widget(); ?>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $(".radiotype").change(function () {
            var idt = $(this).val();
            $.ajax({
                url: "<?= yii\helpers\Url::to("?r=batdongsan/default/phanloai"); ?>",
                type: "POST",
                data: {loai: idt},
                success: function (data) {
                    console.log(data);
                    $('.loai_id').html(data);
                },
            });
        });
        $('[title],textarea').attr('title', function (i, title) {
            $(this).data('title', title).removeAttr('title');
        });

    });
</script>