<?php
use mihaildev\ckeditor\CKEditor;
?>
    <?php if ($loadImage): ?>
    <a class="btn btn-default " onclick="showPopupImage('','',2,<?= "CKEDITOR.instances.".$field ?>)">Thêm ảnh</a>
    <?php endif; ?>
<?=
$form->field($model, $field)->widget(CKEditor::className(), [
    'editorOptions' => [
        'preset' => 'full', //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
        'inline' => false, //по умолчанию false
    ],
    'options' => [
        'id' => $field
    ]
]);
?>