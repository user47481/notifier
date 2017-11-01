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
use notifier\models\query\NotifierHistoryQuery;
use notifier\Module;
use yii\behaviors\TimestampBehavior;
use Yii;
use notifier\senders\EmailSender;
use notifier\senders\SmsSender;
use yii\helpers\ArrayHelper;

/**
 * Class NotifierHistory
 * @package notifier\models\db
 * @property string $data
 * @property string $message
 */
class NotifierHistory extends MainModel
{

    /**
     * @return string
     */
    public static function tableName()
    {
        return '{{%notifier_history}}';
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
          [['template_id','data'],'safe']
        ];
    }

    /**
     * Labels for attributes
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'data'=>Yii::t('notifier','Data'),
            'template_id'=>Yii::t('notifier','Template')
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

            'data' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
            ],
            'template_id' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(NotifierTemplates::find()->all(),'id','label'),
                'options' => [
                    'prompt' => Yii::t('notifier','Select sender'),
                ],
            ],
        ];

    }

    public function getTemplate(){
        return $this->hasOne(NotifierTemplates::className(),['id'=>'template_id']);
    }

    public static function find()
    {
        return new NotifierHistoryQuery(get_called_class());
    }

}