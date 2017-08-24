<?php

namespace frontend\modules\home\models;

use common\models\Member;
use yii\base\Model;
use Yii;

/**
 * Signup form
 */
class ChangePasswordForm extends Model {

    public $password_old;
    public $password_repeat;
    public $password;
    public function attributeLabels()
    {
        return [
            'password_old' =>'Mật khẩu cũ', //Yii::t('app', 'MEMBER_CHANGE_PASSWORD_OLD'),
            'password_repeat' => 'Nhắc lại mật khẩu',//Yii::t('app', 'MEMBER_CHANGE_PASSWORD_REPEAT'),
            'password' => 'Mật khẩu mới',//Yii::t('app', 'MEMBER_CHANGE_PASSWORD_NEW'),
        ];
    }
    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            ['password_old','validatePasswordOld','enableClientValidation' => TRUE],
            [['password','password_old','password_repeat'], 'required'],
            [['password','password_old','password_repeat'], 'string'],
            ['password_repeat', 'compare', 'compareAttribute' => 'password', 'message' => 'Hai mật khẩu không trùng nhau'],
            [['password','password_old','password_repeat'], 'string', 'min' => 6],
        ];
    }
    public function validatePasswordOld($attribute, $params)
    {
        $model = Member::findOne(Yii::$app->user->id);
        if ($model && !$model->validatePassword($this->password_old)) {
            $this->addError($attribute, 'Mật khẩu cũ không chính xác');
        }
    }
    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function changepassword() {
        $model = Member::findOne(Yii::$app->user->id);
        if ($model) {
            $model->setPassword($this->password);
            return $model->save();
        }
        return FALSE;
    }

}
