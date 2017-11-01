<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:52 AM
 */
?>
<div class="senders-update">
    <?php
    if(Yii::$app->session->hasFlash('clientCreated')){
        echo Yii::$app->session->getFlash('clientCreated');
    }
    ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
