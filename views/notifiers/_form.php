<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:52 AM
 */
use metalguardian\formBuilder\ActiveFormBuilder;
use yii\bootstrap\Html;

?>
<div class="box">
    <div class="box-body">
        <?php echo $form->renderForm($model, $model->prepareFormLangConfig($model->getFormConfig(),$l)); ?>
    </div>
</div>