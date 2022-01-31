<?php

namespace common\modules\company\models;

use common\behaviors\TagDependencyBehavior;
use common\behaviors\TimestampBehavior;
use common\modules\company\models\query\IndustryQuery;

/**
 * This is the model class for table "industry".
 *
 * @property int $id
 * @property string $name
 * @property int|null $type_id
 * @property string|null $created_at
 * @property string|null $updated_at
 *
 * @property IndustryType $industryTypeRelation
 */
class Industry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%industry}}';
    }

    /**
     * @return string[]
     */
    public function behaviors()
    {
        return [
            'TimestampBehavior' => TimestampBehavior::class,
            'TagDependencyBehavior' => TagDependencyBehavior::class
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name', 'type_id'], 'required'],
            [['type_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [
                ['type_id'],
                'exist',
                'skipOnError' => true,
                'targetClass' => IndustryType::class,
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
            'name' => 'Название',
            'type_id' => 'Тип отрасли',
            'created_at' => 'Создано',
            'updated_at' => 'Обновлено',
        ];
    }

    /**
     * Gets query for [[IndustryType]].
     *
     * @return \yii\db\ActiveQuery|IndustryQuery
     */
    public function getIndustryTypeRelation()
    {
        return $this->hasOne(IndustryType::class, ['id' => 'type_id']);
    }

    /**
     * {@inheritdoc}
     * @return IndustryQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IndustryQuery(get_called_class());
    }

    /**
     * Список отраслей в формате, подходящем для вывода в выпадающий список
     *
     * @return array
     */
    public static function asDropdown(): array
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
