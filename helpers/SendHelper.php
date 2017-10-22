<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:15 PM
 */

namespace notifier\helpers;


use notifier\senders\Sender;
use yii\base\Exception;

class SendHelper
{
    private $_models;
    private $_historyHelper;
    private $_template;
    private $_type;
    private $_sender;

    public function __construct($models,HistoryHelper $historyHelper,$template)
    {
        $this->_historyHelper = $historyHelper;
        $this->_models = $models;
        $this->_template = $template;
        $this->_type = $this->_template->type_id;
        $this->_sender = $this->prepareSender();
    }

    public function Notify(){
        $this->dataGuard($this->_models);
        foreach ($this->_models as $model){
            $this->send($model);
        }
    }

    private function dataGuard($models){
        if(!$models){
            throw new Exception(\Yii::t('notifier','Модели для рассылки пусты'));
        }
    }

    /**
     * @param $class Sender
     */
    private function send($model){
        try{
            /* @var $sender Sender */
            $sender->send($model,$this->_template);
        }catch (Exception $e){
            echo \Yii::t('notifier','Что-то пошло не так:') . $e->getMessage();
        }
    }

    private function prepareSender(){
        try{
            $className = $this->_type.'Sender';
            return new $className($this->_template);
        }catch (Exception $e){
            echo \Yii::t('notifier','Класс сендера не создан:') . $e->getMessage();
        }
    }

}