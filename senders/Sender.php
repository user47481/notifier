<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:33 PM
 */

namespace notifier\senders;


use notifier\interfaces\SenderAction;

class Sender implements SenderAction
{
    private $_template;

    public function __construct($template)
    {
        $this->_template = $template;
    }

    public function send($model,$template)
    {
        $this->prepare();

    }

    public function prepare()
    {
        // TODO: Implement prepare() method.
    }

}