<?php

namespace frontend\modules\home\controllers;
use common\models\Category;
use common\models\Posts;
use common\models\Slug;
use frontend\controllers\FrontEndController;
use yii\web\Controller;
use Yii;
class DefaultController extends FrontEndController
{
    public function actionIndex()
    {
        $categorys = Category::find()->where(['id' => [1, 2]])->all();
        return $this->render('index', ['categorys' => $categorys]);
    }
}
