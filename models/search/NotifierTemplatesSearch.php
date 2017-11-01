<?php
/**
 * Created by PhpStorm.
 * User: filipp
 * Date: 29.10.17
 * Time: 11:37 AM
 */

namespace notifier\models\search;


use notifier\models\db\NotifierTemplates;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class NotifierTemplatesSearch extends NotifierTemplates
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','type_id','label'], 'safe'],
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
            'type_id' => $this->type_id,
            'label' => $this->label,
        ]);


        return $dataProvider;
    }
}