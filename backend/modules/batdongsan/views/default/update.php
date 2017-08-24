<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\batdongsan\models\Batdongsan */

$this->title =  $model->ten;
$this->params['breadcrumbs'][] = ['label' => 'Tất cả', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Chỉnh sửa';
?>
<div class="batdongsan-update">

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
