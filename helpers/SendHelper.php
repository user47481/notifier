<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:15 PM
 */

namespace notifier\helpers;


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
     * @var
     */
    private $_models;
    /**
     * @var HistoryHelper
     */
    private $_historyHelper;
    /**
     * @var
     */
    private $_template;
    /**
     * @var
     */
    private $_type;
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
    public function __construct($models, HistoryHelper $historyHelper,$template)
    {
        $this->_historyHelper = $historyHelper;
        $this->_models = $models;
        $this->_template = $template;
        $this->_type = $this->_template->type_id;
        $this->_sender = $this->getSender();
    }

    /**
     *
     */
    public function notify(){
        $this->dataGuard($this->_models);
        foreach ($this->_models as $model){
            $this->send($model);
        }
    }

    /**
     * @param $models
     * @throws Exception
     */
    private function dataGuard($models){
        if(!$models){
            throw new Exception(Yii::t('notifier','Модели для рассылки пусты'));
        }
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
    private function prepareSender(){
        try{
            return new $this->_type($this->_template);
        }catch (Exception $e){
            echo Yii::t('notifier','Класс сендера не создан:') . $e->getMessage();
        }
    }

    private function getSender(){
        $class = $this->_template->sender->class;
        return new $class($this->_template);
    }

}