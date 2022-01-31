<?php

namespace common\validators;

use yii\base\Model;
use yii\base\NotSupportedException;

class StringValidator extends \yii\validators\StringValidator
{
    /**
     * @param Model $model
     * @param string $attribute
     */
    public function validateAttribute($model, $attribute)
    {
        if (is_string($model->{$attribute})) {
            $model->{$attribute} = $this->purify($model->{$attribute});
            $model->{$attribute} = $this->trim($model->{$attribute});
        }

        parent::validateAttribute($model, $attribute);
    }

    /**
     * @param mixed $value
     *
     * @return array|null
     * @throws NotSupportedException
     */
    protected function validateValue($value)
    {
        if (is_string($value)) {
            $value = $this->purify($value);
            $value = $this->trim($value);
        }

        return parent::validateValue($value);
    }

    /**
     * @param string $value
     *
     * @return string
     */
    protected function purify(string $value): string
    {
        return preg_replace('#<script(.*?)>(.*?)</script>#is', '', $value);
    }

    /**
     * @param string $value
     *
     * @return string
     */
    protected function trim(string $value): string
    {
        return trim($value);
    }
}
