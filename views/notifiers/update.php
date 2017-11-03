<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:52 AM
 */
use common\helpers\Lang;
use metalguardian\formBuilder\ActiveFormBuilder;
use yii\bootstrap\Html;
use yii\bootstrap\Tabs;
$this->context->layout = '//common';
?>
<div class="senders-update">
    <?php
    if(Yii::$app->session->hasFlash('clientCreated')){
        echo Yii::$app->session->getFlash('clientCreated');
    }
    ?>
    <?php
    $form = ActiveFormBuilder::begin();
    $lang = Lang::getLanguages();
    $langTabs = [];
    foreach ($lang as $l=>$label){
        array_push($langTabs,['label'=>$label,'content'=>$this->render('//templates/_form',compact('model','form','l'))]);
    }
    ?>
    <div class="row">
        <div class="col-md-8">
            <?php echo Tabs::widget([
                'items'=>[
                    ['label'=>'Основное','content'=>$this->render('_lang_form', compact('model','langTabs','form'))],
                ]
            ]); ?>
        </div>
        <div class="col-md-4" style="margin-top: 42px;">
            <div class="box">
                <div class="box-body">
                    <?php echo $form->renderForm($model, $model->prepareFormConfig($model->getFormSelectItems()));; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'),
            ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveFormBuilder::end(); ?>
</div>
