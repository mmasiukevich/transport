<?php

/**
 * Common transport implementation interfaces.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common;

/**
 * Binding the topic to the topic.
 *
 * @property-read Topic       $destinationTopic
 * @property-read string|null $routingKey
 */
class TopicBind
{
    /**
     * The topic to which the binding is going.
     *
     * @var Topic
     */
    public $destinationTopic;

    /**
     * Binding Key.
     *
     * @var string|null
     */
    public $routingKey;

    /**
     * @param Topic       $destinationTopic
     * @param string|null $routingKey
     *
     * @return static
     */
    public static function create(Topic $destinationTopic, ?string $routingKey = null): self
    {
        return new self($destinationTopic, $routingKey);
    }

    /**
     * @param Topic       $destinationTopic
     * @param string|null $routingKey
     */
    private function __construct(Topic $destinationTopic, ?string $routingKey = null)
    {
        $this->destinationTopic = $destinationTopic;
        $this->routingKey       = $routingKey;
    }
}
