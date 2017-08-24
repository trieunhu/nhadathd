<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\batdongsan\models\Chudautu */

$this->title = $model->ten;
$this->params['breadcrumbs'][] = ['label' => 'Tất cả', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Chỉnh sửa';
?>
<div class="chudautu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
