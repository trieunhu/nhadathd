<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\posts\models\Category */

$this->title =  $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Tất cả', 'url' => ['index','type'=>$type]];
$this->params['breadcrumbs'][] = 'Chỉnh sửa';
?>
<div class="category-update">
    <p>
        <?= Html::a('Tạo mới', ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'type'=>$type
    ]) ?>

</div>
