<?php

namespace common\behaviors;

use DateTime;
use yii\base\Event;

class TimestampBehavior extends \yii\behaviors\TimestampBehavior
{
    /**
     * @var string
     */
    public $createdAtAttribute = 'created_at';

    /**
     * @var string
     */
    public $updatedAtAttribute = 'updated_at';

    /**
     * @param Event $event
     *
     * @return string
     */
    protected function getValue($event)
    {
        return $this->value ?: (new DateTime())->format('Y-m-d H:i:s');
    }
}