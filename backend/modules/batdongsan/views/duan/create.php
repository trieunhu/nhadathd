<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\modules\batdongsan\models\Duan */

$this->title = 'Tạo dự án';
$this->params['breadcrumbs'][] = ['label' => 'Tất cả', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="duan-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
