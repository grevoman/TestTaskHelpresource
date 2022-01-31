<?php

namespace common\modules\company\models\search;

use common\modules\company\models\IndustryType;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\modules\company\models\Industry;

/**
 * IndustrySearch represents the model behind the search form of `common\modules\company\models\Industry`.
 */
class IndustrySearch extends Industry
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'type_id'], 'integer'],
            [['name', 'created_at', 'updated_at', 'industryTypeRelation.name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * @return array|string[]
     */
    public function attributes(): array
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), ['industryTypeRelation.name']);
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
        $query = Industry::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->joinWith('industryTypeRelation');

        $dataProvider->sort->attributes['industryTypeRelation.name'] = [
            'asc' => [IndustryType::tableName() . '.[[name]]' => SORT_ASC],
            'desc' => [IndustryType::tableName() . '.[[name]]' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', Industry::tableName() . '.[[name]]', $this->name]);
        $query->andFilterWhere(['like', IndustryType::tableName() . '.[[name]]', $this->getAttribute('industryTypeRelation.name')]);

        return $dataProvider;
    }
}
