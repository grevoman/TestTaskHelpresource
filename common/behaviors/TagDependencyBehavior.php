<?php

namespace common\behaviors;

use yii\base\Behavior;
use yii\base\Event;
use yii\base\InvalidConfigException;
use yii\caching\CacheInterface;
use yii\caching\TagDependency;
use yii\db\ActiveRecord;
use yii\di\Instance;

/**
 * Class TagDependencyBehavior
 *
 * ```php
 * public function behaviors()
 * {
 *     return [
 *         'TagDependencyBehavior' => TagDependencyBehavior::class,
 *     ];
 * }
 * ```
 *
 * use
 *
 * ```php
 * $dependency = new TagDependency([
 *      'tags' => [
 *          Model::class, // OR | AND
 *          Model::tableName(), // OR | AND
 *      ],
 * ]);
 * ```
 *
 * @package krok\extend\behaviors
 */
class TagDependencyBehavior extends Behavior
{
    /**
     * @var string|CacheInterface
     */
    public $cache = 'cache';

    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_INSERT => 'invalidate',
            ActiveRecord::EVENT_AFTER_UPDATE => 'invalidate',
            ActiveRecord::EVENT_AFTER_DELETE => 'invalidate',
        ];
    }

    /**
     * @param Event $event
     *
     * @throws InvalidConfigException
     */
    public function invalidate(Event $event)
    {
        /** @var ActiveRecord $sender */
        $sender = $event->sender;

        /** @var CacheInterface $cache */
        $cache = Instance::ensure($this->cache, CacheInterface::class);

        $tags = [
            get_class($sender),
            $sender::tableName(),
        ];

        TagDependency::invalidate($cache, $tags);
    }
}
