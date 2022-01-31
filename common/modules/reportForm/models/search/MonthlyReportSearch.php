<?php

namespace common\modules\reportForm\models\search;

use common\modules\company\models\Company;
use common\modules\company\models\Industry;
use common\modules\reportForm\models\MonthlyReport;
use common\modules\reportForm\models\query\MonthlyReportQuery;
use DateTime;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * MonthlyReportSearch represents the model behind the search form of `common\modules\reportForm\models\MonthlyReport`.
 */
class MonthlyReportSearch extends MonthlyReport
{
    /**
     * @var string|null
     */
    public ?string $reportRangeStart = null;

    /**
     * @var string|null
     */
    public ?string $reportRangeEnd = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'workers'], 'integer'],
            [['salary', 'taxes', 'energy_amount'], 'number'],
            [
                [
                    'energy_organization',
                    'created_at',
                    'updated_at',
                    'companyRelation.name',
                    'companyRelation.industry_id',
                    'companyRelation.industryRelation.type_id',
                    'reportRangeStart',
                    'reportRangeEnd',
                ],
                'safe',
            ],
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
        return array_merge(
            parent::attributes(),
            ['companyRelation.name', 'companyRelation.industry_id', 'companyRelation.industryRelation.type_id']
        );
    }

    /**
     * @param array $params
     *
     * @return MonthlyReportQuery
     */
    public function searchQuery(array $params): MonthlyReportQuery
    {
        $query = MonthlyReport::find();
        $query->joinWith('companyRelation.industryRelation');
        $this->load($params);

        if (!$this->validate()) {
            return $query;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'workers' => $this->workers,
            'salary' => $this->salary,
            'taxes' => $this->taxes,
            'energy_amount' => $this->energy_amount,
        ]);

        $query->andFilterWhere(['like', MonthlyReport::tableName() . '.[[energy_organization]]', $this->energy_organization]);
        $query->andFilterWhere(['like', MonthlyReport::tableName() . '.[[created_at]]', $this->created_at]);
        $query->andFilterWhere(['like', MonthlyReport::tableName() . '.[[updated_at]]', $this->updated_at]);
        $query->andFilterWhere(['like', Company::tableName() . '.[[name]]', $this->getAttribute('companyRelation.name')]
        );
        $query->andFilterWhere(
            [Company::tableName() . '.[[industry_id]]' => $this->getAttribute('companyRelation.industry_id')]
        );
        $query->andFilterWhere(
            [Industry::tableName() . '.[[type_id]]' => $this->getAttribute('companyRelation.industryRelation.type_id')]
        );

        if ($reportRangeStart = DateTime::createFromFormat('Y-m-d', $this->reportRangeStart) ?: null) {
            $reportRangeStart = $reportRangeStart->format('Y-m-d');
        }

        if ($reportRangeEnd = DateTime::createFromFormat('Y-m-d', $this->reportRangeEnd) ?: null) {
            $reportRangeEnd = $reportRangeEnd->modify('+1 day')->format('Y-m-d');
        }

        $query->andFilterWhere(['>', MonthlyReport::tableName() . '.[[created_at]]', $reportRangeStart]);
        $query->andFilterWhere(['<', MonthlyReport::tableName() . '.[[created_at]]', $reportRangeEnd]);

        return $query;
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search(array $params): ActiveDataProvider
    {
        $dataProvider = new ActiveDataProvider([
            'query' => $this->searchQuery($params),
        ]);

        $dataProvider->sort->attributes['companyRelation.name'] = [
            'asc' => [Company::tableName() . '.[[name]]' => SORT_ASC],
            'desc' => [Company::tableName() . '.[[name]]' => SORT_DESC],
        ];

        return $dataProvider;
    }
}
