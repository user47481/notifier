<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:06 AM
 */

namespace notifier\models\db;


use common\components\MainModel;
use metalguardian\formBuilder\ActiveFormBuilder;
use notifier\models\query\NotifierSendersQuery;
use notifier\Module;
use yii\behaviors\TimestampBehavior;
use Yii;
use notifier\senders\EmailSender;
use notifier\senders\SmsSender;
/**
 * Class NotifierSenders
 * @package notifier\models\db
 * @property string $label
 * @property integer $type_id
 * @property string $message
 */
class NotifierTemplatesLang extends MainModel
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%notifier_templates_lang}}';
    }

    public function rules()
    {
        return [
            [['notifier_templates_id', 'language', 'label', 'message'], 'safe'],
        ];
    }


}