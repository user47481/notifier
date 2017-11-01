<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:37 AM
 */

namespace notifier\models\search;


use notifier\models\db\NotifierSenders;
use notifier\models\db\NotifierTemplates;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NotifierHistorySearch extends NotifierSenders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','label','class'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = parent::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'class' => $this->class,
            'label' => $this->label,
        ]);


        return $dataProvider;
    }
}