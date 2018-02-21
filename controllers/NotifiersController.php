<?php
namespace notifier\controllers;

use backend\models\search\NewsSearch;
use common\models\News;
use keyStorage\models\FormModel;
use notifier\helpers\CrudController;
use notifier\models\db\NotifierSenders;
use notifier\models\db\NotifierTemplates;
use notifier\models\search\NotifierSendersSearch;
use notifier\models\search\NotifierTemplatesSearch;
use Yii;

class NotifiersController extends CrudController
{
    public $labelMany = 'Уведомления';

    public $labelOne = 'Уведомление';

    public $multilang = true;

    public $indexTemplate = 'index';
    public $createTemplate = 'create';
    public $updateTemplate = 'update';

    public function getModelClass(){
        return  NotifierTemplates::className();
    }

    public function getModelSearchClass(){
        return  NotifierSendersSearch::className();
    }

}