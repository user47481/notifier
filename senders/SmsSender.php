<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:22 PM
 */

namespace notifier\senders;


use notifier\interfaces\SenderAction;
use trntv\filekit\widget\Upload;
use Yii;
use keyStorage\models\forms\FormModel;

class SmsSender extends Sender
{
    public function send($model)
    {
        $client = $this->prepare();
        $sms = new \Zelenin\SmsRu\Entity\Sms($model->phone, $this->template->message);
        $client->test = 1;
        $client->smsSend($sms);
    }

    public function prepare()
    {
        $client = new \Zelenin\SmsRu\Api(new \Zelenin\SmsRu\Auth\ApiIdAuth(cv('sms_sender.api_id')));
        return $client;
    }

    public static function settings(){
        return [
            'keys' => [
                'sms_sender.status' => [
                    'label' => Yii::t('sms_sender', 'Module Status'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
                'sms_sender.api_id' => [
                    'label' => Yii::t('sms_sender', 'SMS API ID'),
                    'type' => FormModel::TYPE_TEXTINPUT,
                ],
            ]
        ];
    }

}