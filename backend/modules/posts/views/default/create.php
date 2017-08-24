<?php

use yii\helpers\Html;
use backend\modules\posts\models\Posts;

/* @var $this yii\web\View */
/* @var $model backend\modules\posts\models\Posts */

$this->title = 'Tạo bài viết mới';
if ($type == Posts::TYPE_PAGE){
    $this->title = 'Tạo page mới';
    $this->params['breadcrumbs'][] = ['label' => 'Page', 'url' => ['index','type'=>$type]];
}else{
    $this->params['breadcrumbs'][] = ['label' => 'Bài viết', 'url' => ['index']];
}
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="posts-create">
    <p>
        <?= Html::a('Tạo mới', ['create','type'=>$type], ['class' => 'btn btn-success']) ?>
    </p>
   <h1><?= Html::encode($this->title) ?></h1>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
