<?php

namespace frontend\modules\home\models;

use common\models\Images;
use common\models\MemberProfile;
use common\models\PostRelationships;
use Yii;

class MemberInfo extends \common\models\Member
{
    public $facebook;
    public $skype;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'display_name'], 'required'],
            ['email','email'],
            [['username'], 'string', 'max' => 25],
            [['display_name','address'], 'string', 'max' => 100],
            [['facebook','skype'], 'string', 'max' => 100],
            [['mobile'], 'string', 'max' => 20],
        ];
    }
    function SaveDB(){
        $image = Yii::$app->request->post('images');
        if (count($image) > 0){
            $image_id = $image[0];
            $modelImage = Images::findOne($image_id);
            if ($modelImage){
                if ($this->image && $this->image->id != $image_id){
                    $this->image->Xoa();
                }else{
                    $modelImage->status = Images::STATUS_MEMBER;
                    $modelImage->save();
                    PostRelationships::setPost($image_id, $this->id, Images::tableName(), $this->tableName());
                }
            }
        }
        $profile = $this->profile;
        if (!$profile){
            $profile = new MemberProfile();
            $profile->member_id = $this->id;
        }
        $profile->skype = $this->skype;
        $profile->facebook = $this->facebook;
        $profile->save();
        $this->save();
        return true;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Tên đăng nhập'),
            'display_name' => Yii::t('app', 'Họ và tên'),
            'mobile' => Yii::t('app', 'Số điện thoại'),
            'address' => Yii::t('app', 'Địa chỉ'),
            'parent_id' => Yii::t('app', 'Parent ID'),
            'password' => Yii::t('app', 'Mật khẩu'),
            'password_repeat' => Yii::t('app', 'Nhắc lại mật khẩu'),
            'verifyCode' => Yii::t('app', 'Mã xác thực'),
            'email' => Yii::t('app', 'Email'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
