<?php

use yii\helpers\Html;
use backend\modules\posts\models\Posts;
/* @var $this yii\web\View */
/* @var $model backend\modules\posts\models\Posts */

$this->title = $model->title;
if ($model->type == Posts::TYPE_PAGE){
    $this->params['breadcrumbs'][] = ['label' => 'Page', 'url' => ['index','type'=>$model->type]];
}else{
    $this->params['breadcrumbs'][] = ['label' => 'Bài viết', 'url' => ['index']];
}
$this->params['breadcrumbs'][] = 'Chỉnh sửa';
?>
<div class="posts-update">
    <p>
        <?= Html::a('Tạo mới', ['create','type'=>$model->type], ['class' => 'btn btn-success']) ?>
    </p>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
