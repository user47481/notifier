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
     * Updates an existing KeyStorageItem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $senderClass = $model->class;
        $settings = new \keyStorage\models\forms\FormModel( $senderClass::settings() );

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Изменения сохранены');
            $this->refresh();
            return false;
        }elseif($settings->load(Yii::$app->request->post()) && $settings->save()) {
            \Yii::$app->getSession()->setFlash('success', 'Изменения сохранены');
            $this->refresh();
            return false;
        }else{
            return $this->render($this->updateTemplate, [
                'model' => $model,
                'settings' => $settings
            ]);
        }
    }
}