<?php

namespace common\modules\reportForm\models\query;

/**
 * This is the ActiveQuery class for [[\common\modules\reportForm\models\MonthlyReport]].
 *
 * @see \common\modules\reportForm\models\MonthlyReport
 */
class MonthlyReportQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\reportForm\models\MonthlyReport[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\reportForm\models\MonthlyReport|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
