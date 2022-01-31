<?php

namespace common\modules\company\models;

use common\behaviors\TimestampBehavior;

/**
 * This is the model class for table "company".
 *
 * @property int $id
 * @property string $name
 * @property int $type_id
 * @property int $industry_id
 * @property string $inn
 * @property string $address
 * @property string $phone
 * @property string $email
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property Industry $industryRelation
 * @property CompanyType $typeRelation
 */
class Company extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company}}';
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
            [['name', 'inn', 'address', 'phone',], 'string', 'max' => 255],
            [['name', 'type_id', 'industry_id', 'inn', 'address', 'phone', 'email'], 'required'],
            [['type_id', 'industry_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            ['inn', 'match', 'pattern' => '/^\d{10}$/'],
            [['email'], 'email'],
            [
                ['industry_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => Industry::class,
                'targetAttribute' => ['industry_id' => 'id'],
            ],
            [
                ['type_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => CompanyType::class,
                'targetAttribute' => ['type_id' => 'id'],
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
            'name' => 'Наименование',
            'type_id' => 'Тип',
            'industry_id' => 'Отрасль',
            'inn' => 'ИНН',
            'address' => 'Адрес',
            'phone' => 'Телефон',
            'email' => 'Email',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[Industry]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\company\models\query\IndustryQuery
     */
    public function getIndustryRelation()
    {
        return $this->hasOne(Industry::class, ['id' => 'industry_id']);
    }

    /**
     * Gets query for [[Type]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\company\models\query\CompanyTypeQuery
     */
    public function getTypeRelation()
    {
        return $this->hasOne(CompanyType::class, ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\query\CompanyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\company\models\query\CompanyQuery(get_called_class());
    }

    /**
     * Список предприятий в формате, подходящем для вывода в выпадающий список
     *
     * @return array
     */
    public static function asDropdown(): array
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
