<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property integer $id
 * @property integer $batdongsan_id
 * @property integer $member_id
 * @property integer $count_day
 * @property integer $money
 * @property integer $status
 * @property string $created_at
 */
class Transaction extends \yii\db\ActiveRecord
{
    const STATUS_PEDDING = 0;
    const STATUS_COMPLETE = 1;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['batdongsan_id', 'member_id', 'count_day', 'status'], 'integer'],
            [['created_at'], 'safe'],
        ];
    }
    public static function create($bid,$mid,$count,$money,$status){
        $m = new self();
        $m->money = $money;
        $m->batdongsan_id = $bid;
        $m->member_id = $mid;
        $m->count_day = $count;
        $m->status = $status;
        $m->save();
        return $m;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'batdongsan_id' => Yii::t('app', 'Batdongsan ID'),
            'member_id' => Yii::t('app', 'Member ID'),
            'count_day' => Yii::t('app', 'Count Day'),
            'money' => Yii::t('app', 'Money'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
}
