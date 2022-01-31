<?php

namespace common\modules\company\models\query;

use common\modules\company\models\Industry;

/**
 * This is the ActiveQuery class for [[Industry]].
 *
 * @see Industry
 */
class IndustryQuery extends \yii\db\ActiveQuery
{
    /**
     * {@inheritdoc}
     * @return Industry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Industry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
