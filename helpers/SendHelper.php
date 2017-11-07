<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:15 PM
 */

namespace notifier\helpers;


use notifier\models\db\NotifierTemplates;
use notifier\Module;
use notifier\senders\Sender;
use yii\base\Exception;
use Yii;

/**
 * Class SendHelper
 * @package notifier\helpers
 */
class SendHelper
{
    /**
     * @var HistoryHelper
     */
    private $_historyHelper;
    /**
     * @var
     */
    private $_template;
    /**
     * @var mixed
     */
    private $_sender;

    /**
     * SendHelper constructor.
     * @param $models
     * @param HistoryHelper $historyHelper
     * @param $template
     */
    public function __construct(HistoryHelper $historyHelper, NotifierTemplates $template)
    {
        $this->_historyHelper = $historyHelper;
        $this->_template = $template;
        $this->_sender = $this->getSender();
    }

    /**
     * @param $model Sender
     */
    public function send($model){
        try{
            /* @var $sender Sender */
            $this->_sender->send($model);
        }catch (Exception $e){
            echo Yii::t('notifier','Что-то пошло не так:') . $e->getMessage();
        }
    }

    /**
     * @return Sender
     */
    private function getSender(){
        $class = $this->_template->sender->class;
        return new $class($this->_template);
    }

}