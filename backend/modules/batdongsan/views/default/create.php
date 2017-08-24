<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\batdongsan\models\Batdongsan */

$this->title = 'Tạo mới';
$this->params['breadcrumbs'][] = ['label' => 'Tất cả', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="batdongsan-create">

    <p>
        <?= Html::a('Tạo mới', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
