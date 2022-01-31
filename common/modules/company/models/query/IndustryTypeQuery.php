<?php

namespace common\modules\company\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\company\models\IndustryType]].
 *
 * @see \common\modules\company\models\IndustryType
 */
class IndustryTypeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\IndustryType[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\IndustryType|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
