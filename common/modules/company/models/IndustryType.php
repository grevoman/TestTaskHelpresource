<?php

namespace common\modules\company\models;

use Yii;

/**
 * This is the model class for table "industry_type".
 *
 * @property int $id
 * @property string $name
 *
 * @property Industry[] $industries
 */
class IndustryType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%industry_type}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
            [['name'], 'required'],
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
        ];
    }

    /**
     * Gets query for [[Industries]].
     *
     * @return \yii\db\ActiveQuery|\common\modules\company\models\query\IndustryQuery
     */
    public function getIndustries()
    {
        return $this->hasMany(Industry::className(), ['type_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\query\IndustryTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\company\models\query\IndustryTypeQuery(get_called_class());
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
