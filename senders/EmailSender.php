<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:22 PM
 */

namespace notifier\senders;


use notifier\interfaces\SenderAction;

class EmailSender extends Sender implements SenderAction
{
    public function send($model,$template)
    {
        // TODO: Implement send() method.
    }

    public function prepare()
    {
        // TODO: Implement prepare() method.
    }

}