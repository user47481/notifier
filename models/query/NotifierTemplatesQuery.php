<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:08 AM
 */

namespace notifier\models\query;

use yii\db\ActiveQuery;

class NotifierTemplatesQuery extends ActiveQuery
{

    public function all($db = null){
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }

}