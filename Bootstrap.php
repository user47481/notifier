<?php
/**
 * Created by PhpStorm.
 * User: Mopkau
 * Date: 08.10.2017
 * Time: 19:35
 */

namespace notifier;


use yii\base\BootstrapInterface;

class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {
        $app->setModule('notifier',[
            'class'=>'notifier\Module',
            'defaultRoute'=>'admin'
        ]);

    }
}