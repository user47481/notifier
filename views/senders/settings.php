<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:53 AM
 */
use keyStorage\widgets\FormWidget;

?>
<div class="box">
    <div class="box-body">
        <?php echo FormWidget::widget([
            'model' => $model,
            'formClass' => '\yii\bootstrap\ActiveForm',
            'submitText' => Yii::t('backend', 'Save'),
            'submitOptions' => ['class' => 'btn btn-primary']
        ]); ?>
    </div>
</div>
