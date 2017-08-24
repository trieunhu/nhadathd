<?php

namespace frontend\modules\home\controllers;

use common\models\Fee;
use common\models\Member;
use common\models\Transaction;
use frontend\controllers\FrontEndController;
use frontend\modules\home\models\BatdongsanForm;
use frontend\modules\home\models\MemberInfo;
use Yii;
use frontend\models\PostRelationships;
use common\models\Images;
use common\models\Category;
use common\models\Diadiem;
use common\func\FunctionCommon;
use common\models\Slug;
class BatdongsanController extends FrontEndController
{
    public $layout = "@app/views/layouts/main_member";

    public function actionCreate()
    {
        $model = new BatdongsanForm();
        $fees = Fee::find()->all();
        $member = null;
        if (!Yii::$app->user->isGuest){
            $member = Member::findOne(Yii::$app->user->id);
            if ($member){
                $model->address = $member->address;
                $model->display_name = $member->display_name;
                $model->email = $member->email;
                $model->mobile = $member->mobile;
            }
        }
        $model->ngay_het_han = date('d/m/Y',strtotime('+30 day',strtotime(date('Y-m-d'))));
        if ($model->load(Yii::$app->request->post()) && $model->validate()){
            if ($member){
                $model->member_id = $member->id;
            }else{
                $currentMember = MemberInfo::findOne(['email'=>$model->email,'mobile'=>$model->mobile]);
                if (!$currentMember){
                    $currentMember = new MemberInfo();
                    $currentMember->email = $model->email;
                    $currentMember->display_name = $model->display_name;
                    $currentMember->mobile = $model->mobile;
                    $currentMember->address = $model->address == null ? '' : $model->address;
                    $currentMember->status = MemberInfo::STATUS_CREATE_BDS;
                    $currentMember->save(false);
                }
                $model->member_id = $currentMember->id;
            }

            $model->ngay_tao = date('Y-m-d H:i:s');
            $model->ngay_hien_thi = date('Y-m-d',strtotime(str_replace("/","-",$model->ngay_hien_thi)));
            $model->ngay_het_han = date('Y-m-d',strtotime(str_replace("/","-",$model->ngay_het_han)));
            $model->status = BatdongsanForm::STATUS_TEMP;
            $diadiem = Diadiem::createPostion($model->tinh_id,$model->huyen_id,$model->xa_id,$model->dia_diem,$model->positionX,$model->positionY);
            if ($diadiem){
                $model->diadiem_id = $diadiem->id;
            }
            if ($model->save()){
                Slug::create($model->id,$model->tableName(),$model->title);
                $countDay = FunctionCommon::minusDate($model->ngay_hien_thi,$model->ngay_het_han);
                $transition =  $model->createTransition($countDay);
                if (isset($_POST['images'])){
                    $images = $_POST['images'];
                    $i = 0;
                    foreach ($images as $value) {
                        $imageModel = Images::findOne(['id' => $value]);
                        if ($imageModel) {
                            if ($i == 0){
                                PostRelationships::setPost($imageModel->id, $model->id, Images::tableName(), $model->tableName());
                            }
                            $imageModel->status = Images::STATUS_ACTIVE;
                            $imageModel->save();
                            PostRelationships::setPost($imageModel->id, $model->id, "slider", $model->tableName());
                            $i++;
                        }
                    }
                }
                $category = Category::findOne($model->category_id);
                if ($category) {
                    PostRelationships::setPost($category->id, $model->id, Category::tableName(), $model->tableName());
                }
                if (!$transition){
                    $transition = new Transaction();
                    $transition->money = 0;
                    $transition->count_day = $countDay;

                }
                return $this->render('succes',['model'=>$model,'transition'=>$transition]);
            }
        }
        return $this->render('create',['model'=>$model,'fees'=>$fees]);
    }

}
