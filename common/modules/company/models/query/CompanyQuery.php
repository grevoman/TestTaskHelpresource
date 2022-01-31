<?php

namespace common\modules\company\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\company\models\Company]].
 *
 * @see \common\modules\company\models\Company
 */
class CompanyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\Company[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\company\models\Company|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
