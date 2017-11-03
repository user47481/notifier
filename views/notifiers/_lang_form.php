<?php
use backend\widgets\HistoryWidget;
use backend\widgets\ProjectEmailSettingsWidget;
use backend\widgets\SmtpWidget;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model common\models\Membership */
/* @var $form \metalguardian\formBuilder\ActiveFormBuilder; */

?>

<div class="article-form">


    <div class="box">
        <div class="box-body">
            <?php
            echo Tabs::widget([
                'items' => $langTabs
            ]);
            ?>
        </div>
    </div>

</div>
