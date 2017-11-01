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
class NotifierSenders extends MainModel
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%notifier_senders}}';
    }

    /**
     * Model behaviors
     * @return array
     */
    public function behaviors()
    {
        return [
          'timestamp' => [
              'class'=>TimestampBehavior::className()
          ]
        ];
    }

    public function rules()
    {
        return [
          [['class','label'],'safe']
        ];
    }

    public static function find()
    {
        return new NotifierSendersQuery(get_called_class());
    }

    /**
     * Labels for attributes
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'label'=>Yii::t('notifier','Label'),
            'class'=>Yii::t('notifier','Select class')
        ];
    }

    /**
     * Columns for CRUD
     * @return array
     */
    public function getIndexCols()
    {
        return [
            'id',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}'
            ]
        ];
    }

    /**
     * Fields for edit\create form
     * @return array
     */
    public function getFormConfig(){
        return [

            'label' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
            ],
            'class' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => [
                    SmsSender::class => SmsSender::class,
                    EmailSender::class => EmailSender::class
                ],
                'options' => [
                    'prompt' => Yii::t('notifier','Select sender'),
                ],
            ],
        ];

    }

}