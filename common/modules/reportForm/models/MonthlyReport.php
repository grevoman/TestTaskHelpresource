<?php

namespace common\modules\reportForm\models;

use common\behaviors\TimestampBehavior;
use common\modules\company\models\Company;

/**
 * This is the model class for table "monthly_report".
 *
 * @property int $id
 * @property int $company_id
 * @property int $workers
 * @property float $salary
 * @property float $taxes
 * @property float|null $energy_amount
 * @property string|null $energy_organization
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Company $companyRelation
 */
class MonthlyReport extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%monthly_report}}';
    }

    /**
     * @return string[]
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => TimestampBehavior::class,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['company_id', 'workers', 'salary', 'taxes'], 'required'],
            [['energy_organization'], 'string', 'max' => 255],
            [
                ['energy_organization'],
                'required',
                'when' => function (MonthlyReport $model) {
                    return (bool)$this->energy_amount;
                },
                'whenClient' => "function (attribute, value) {
                    return $('#monthlyreport-energy_amount').val() !== '';
                }",
            ],
            [['company_id', 'workers'], 'integer'],
            [['salary', 'taxes', 'energy_amount'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [
                ['company_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Company::class,
                'targetAttribute' => ['company_id' => 'id'],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'company_id' => 'Предприятие',
            'workers' => 'Количество работников, чел.',
            'salary' => 'Средняя зарплата работников, руб.',
            'taxes' => 'Сумма уплаченных налогов, тыс. руб.',
            'energy_amount' => 'Энергоснабжение, сумма начислений, тыс. руб.',
            'energy_organization' => 'Энергоснабжение, наименование поставщика',
            'created_at' => 'Создано',
            'updated_at' => 'Изменено',
        ];
    }

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\company\models\query\CompanyQuery
     */
    public function getCompanyRelation()
    {
        return $this->hasOne(Company::class, ['id' => 'company_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\reportForm\models\query\MonthlyReportQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\reportForm\models\query\MonthlyReportQuery(get_called_class());
    }
}
