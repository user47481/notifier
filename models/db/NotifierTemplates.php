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
use notifier\models\query\NotifierTemplatesQuery;
use notifier\senders\Sender;
use yii\behaviors\TimestampBehavior;
use Yii;
use yii\helpers\ArrayHelper;

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
          ]
        ];
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
                'type' => ActiveFormBuilder::INPUT_TEXT,
            ],
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