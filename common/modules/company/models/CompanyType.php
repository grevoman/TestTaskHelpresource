<?php

namespace common\modules\company\models;

use Yii;

/**
 * This is the model class for table "company_type".
 *
 * @property int $id
 * @property string $name
 */
class CompanyType extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%company_type}}';
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
            'name' => 'Название',
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\query\CompanyTypeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\modules\company\models\query\CompanyTypeQuery(get_called_class());
    }

    /**
     * Список типов предприятий в формате, подходящем для вывода в выпадающий список
     *
     * @return array
     */
    public static function asDropdown(): array
    {
        return self::find()->select(['name', 'id'])->indexBy('id')->column();
    }
}
