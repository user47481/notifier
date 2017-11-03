<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:22 PM
 */

namespace notifier\senders;

use Yii;
use keyStorage\models\forms\FormModel;

class EmailSender extends Sender
{
    public function send($model)
    {
        // TODO: Implement send() method.
    }

    public function prepare()
    {
        // TODO: Implement prepare() method.
    }

    public static function settings()
    {
        return [
        'keys' => [
            'email_sender.status' => [
                'label' => Yii::t('backend', 'Frontend maintenance mode'),
                'type' => FormModel::TYPE_DROPDOWN,
                'items' => [
                    'disabled' => Yii::t('backend', 'Disabled'),
                    'enabled' => Yii::t('backend', 'Enabled')
                ]
            ],
            'email_sender.smtp_host' => [
                'label' => Yii::t('email_sender', 'SMTP HOST'),
                'type' => FormModel::TYPE_TEXTINPUT,
            ],
            'email_sender.smtp_login' => [
                'label' => Yii::t('email_sender', 'SMTP LOGIN'),
                'type' => FormModel::TYPE_TEXTINPUT,
            ],
            'email_sender.smtp_password' => [
                'label' => Yii::t('email_sender', 'SMTP PASSWORD'),
                'type' => FormModel::TYPE_TEXTINPUT,
            ],
            'email_sender.smtp_port' => [
                'label' => Yii::t('email_sender', 'SMTP PORT'),
                'type' => FormModel::TYPE_TEXTINPUT,
            ],
            'email_sender.smtp_encryption' => [
                'label' => Yii::t('email_sender', 'SMTP ENCRYPTION'),
                'type' => FormModel::TYPE_TEXTINPUT,
            ],
        ]
    ];
    }

}