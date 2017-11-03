<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:52 AM
 */
use yii\bootstrap\Tabs;

$this->context->layout = '//common';
?>
<div class="senders-update">
    <?php
    if(Yii::$app->session->hasFlash('clientCreated')){
        echo Yii::$app->session->getFlash('clientCreated');
    }
    ?>
    <?php echo Tabs::widget([
        'items'=>[
            ['label'=>'Основное','content'=>$this->render('_form', compact('model'))],
            ['label'=>'Настройки','content'=>$this->render('_form_settings', compact('settings'))],
        ]
    ]); ?>
</div>
