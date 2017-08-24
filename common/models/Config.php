<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "config".
 *
 * @property integer $id
 * @property string $name
 * @property string $value
 */
class Config extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'config';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'value'], 'required'],
        ];
    }
    public static function getValueConfig($str){
        $config = Config::findOne(['name'=>$str]);
        if ($config) {
            return $config->value;
        }
    }
    public static function setValueConfig($str,$value){
        $config = Config::findOne(['name'=>$str]);
        if ($config) {
            $config->value = $value;
            $config->save();
        }
    }
    public static function sendMail2($emailTo, $subject, $content,$attachs,$cc = false, $layout = 'layouts/html') {
        $emailSend = Yii::$app->mailer->compose(['html' => $layout], ['content' => $content])
            ->setFrom([Yii::$app->params['adminSendEmail']=>Yii::$app->params['nameSendMail']])
            ->setTo($emailTo)
            ->setSubject($subject);
        foreach ($attachs as $key => $attach){
            if ($key == 'file'){
                $emailSend->attach($attach);
            }else{
                $content = $attach['content'];
                $name = $attach['name'];
                $emailSend->attachContent($content,['fileName' => $name,   'contentType' => 'application/pdf']);
            }
        }
        if ($cc){
            $mailCC = Config::getValueConfig('listEmailCC');
            $mailCC = explode(',',$mailCC);
            $emailSend->setCc($mailCC);
        }
        $emailSend->send();
    }
    public static function sendMail($emailTo, $subject, $content,$attach = "",$cc = false, $layout = 'layouts/html') {
        $emailSend = Yii::$app->mailer->compose(['html' => $layout], ['content' => $content])
            ->setFrom([Yii::$app->params['adminSendEmail']=>Yii::$app->params['nameSendMail']])
            ->setTo($emailTo)
            ->setSubject($subject);
        if ($attach != ""){
            $emailSend->attach($attach);
        }
        if ($cc){
            $mailCC = Config::getValueConfig('listEmailCC');
            $mailCC = explode(',',$mailCC);
            $emailSend->setCc($mailCC);
        }
        $emailSend->send();
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'value' => 'Value',
        ];
    }
}
