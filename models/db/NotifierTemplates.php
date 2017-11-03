<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:06 AM
 */

namespace notifier\models\db;


use common\addons\behaviors\Multilang;
use common\components\MainModel;
use common\helpers\Lang;
use metalguardian\formBuilder\ActiveFormBuilder;
use notifier\models\query\NotifierTemplatesQuery;
use notifier\senders\Sender;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "{{%people_forms}}".
 *
 * @property integer $id
 * @property string $label
 * @property string $message
 * @property integer $type_id
 */
class NotifierTemplates extends MainModel
{

    public static function tableName()
    {
        return '{{%notifier_templates}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
              'class'=>TimestampBehavior::className()
            ],
            'multiLang' => [
                'class'           => Multilang::className(),
                'attributes'      => self::getLocalizedAttributesList(),
                'languages'       => Lang::getLanguageKeys(),
                'defaultLanguage' => 'ru',
                'langForeignKey'  => 'notifier_templates_id',
                'tableName'       => "{{%notifier_templates_lang}}",
                'langClassName'   => NotifierTemplatesLang::className(),
            ],
        ];
    }

    public function rules()
    {
        return [
            [['label','message','type_id'],'safe'],
            [['label','message'],'required'],
        ];
    }

    public static function getLocalizedAttributesList()
    {
        return ['label','message'];
    }

    public function attributeLabels()
    {
        return [
            'label'=>'Заголовок',
            'message'=>'Сообщение',
            'type_id'=>Yii::t('notifier','Sender')
        ];
    }

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

    public function getFormConfig(){
        return [

            'label' => [
                'type' => ActiveFormBuilder::INPUT_TEXT,
            ],
            'message' => [
                'type' => ActiveFormBuilder::INPUT_TEXTAREA,
            ],

        ];

    }

    public function getFormSelectItems(){
        return [
            'type_id' => [
                'type' => ActiveFormBuilder::INPUT_DROPDOWN_LIST,
                'items' => ArrayHelper::map(NotifierSenders::find()->all(),'id','label'),
                'options' => [
                    'prompt' => Yii::t('notifier','Select sender'),
                ],
            ],
        ];
    }

    public static function find()
    {
        return new NotifierTemplatesQuery(get_called_class());
    }

    public function getSender(){
        return $this->hasOne(NotifierSenders::className(),['id'=>'type_id']);
    }

}