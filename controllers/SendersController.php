<?php
namespace notifier\controllers;

use backend\models\search\NewsSearch;
use common\models\News;
use keyStorage\models\FormModel;
use notifier\helpers\CrudController;
use notifier\models\db\NotifierSenders;
use notifier\models\db\NotifierTemplates;
use notifier\models\search\NotifierSendersSearch;
use Yii;

class SendersController extends CrudController
{
    public $labelMany = 'Уведомления';

    public $labelOne = 'Уведомление';

    public $multilang = true;

    public function getModelClass(){
        return  NotifierSenders::className();
    }

    public function getModelSearchClass(){
        return  NotifierSendersSearch::className();
    }

    /**
     * @param $id
     */
    public function actionSettings($id){
        $notifierModel = NotifierSenders::findOne(['id'=>$id]);
        $settingsModel = new $notifierModel->class;
        $model = new FormModel([
            'keys'=> $settingsModel->settings()
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('settings', ['model' => $model]);
    }

}