<?php
namespace notifier\controllers;

use backend\models\search\NewsSearch;
use common\models\News;

class AdminController extends \backend\components\BackendController
{
    public $labelMany = 'Баннеры';
    public $labelOne = 'Баннер';
    public $multilang = true;



    public function getModelClass(){
        return  News::className();
    }

    public function getModelSearchClass(){
        return  NewsSearch::className();
    }
}