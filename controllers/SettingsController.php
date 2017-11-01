<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:01 AM
 */

namespace notifier\controllers;


use backend\components\BackendController;
use keyStorage\models\forms\FormModel;
use Yii;

class SettingsController extends BackendController
{
    public function actionSettings()
    {
        $model = new FormModel([
            'keys' => [
                'notifier.status' => [
                    'label' => Yii::t('backend', 'Module status'),
                    'type' => FormModel::TYPE_DROPDOWN,
                    'items' => [
                        'disabled' => Yii::t('backend', 'Disabled'),
                        'enabled' => Yii::t('backend', 'Enabled')
                    ]
                ],
            ]
        ]);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('alert', [
                'body' => Yii::t('backend', 'Settings was successfully saved'),
                'options' => ['class' => 'alert alert-success']
            ]);
            return $this->refresh();
        }

        return $this->render('form', ['model' => $model]);
    }
}