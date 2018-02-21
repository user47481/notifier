<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 19.10.17
 * Time: 2:28 PM
 */

namespace notifier\interfaces;


interface SenderAction
{
    /*
     * Send data by specific sender class
     * */
    public function send($model);
    /*
     * Prepare data form sending
     * */
    public function prepare();

    public function prepareMessage($model);

    public static function settings();

}