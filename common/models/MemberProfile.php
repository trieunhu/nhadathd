<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "member_profile".
 *
 * @property integer $id
 * @property integer $member_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $bank_code
 * @property string $bank_name
 * @property string $bank_agency
 * @property string $card_id
 * @property integer $gender
 * @property string $birth_day
 * @property string $facebook
 * @property string $skype
 */
class MemberProfile extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'member_profile';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['member_id', 'gender'], 'integer'],
            [['created_at', 'updated_at', 'birth_day'], 'safe'],
            [['bank_code', 'bank_name', 'bank_agency', 'card_id', 'facebook', 'skype'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'bank_code' => Yii::t('app', 'Bank Code'),
            'bank_name' => Yii::t('app', 'Bank Name'),
            'bank_agency' => Yii::t('app', 'Bank Agency'),
            'card_id' => Yii::t('app', 'Card ID'),
            'gender' => Yii::t('app', 'Gender'),
            'birth_day' => Yii::t('app', 'Birth Day'),
            'facebook' => Yii::t('app', 'Facebook'),
            'skype' => Yii::t('app', 'Skype'),
        ];
    }
}
