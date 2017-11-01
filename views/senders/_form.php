<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:52 AM
 */
use metalguardian\formBuilder\ActiveFormBuilder;
use yii\bootstrap\Html;

$form = ActiveFormBuilder::begin();
echo $form->renderForm($model,$model->prepareFormConfig($model->getFormConfig()));
echo Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']);
ActiveFormBuilder::end();
?>

