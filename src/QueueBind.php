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
 * Binding the queue to the topic.
 *
 * @property-read Topic       $destinationTopic
 * @property-read string|null $routingKey
 */
class QueueBind
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
    final public static function create(Topic $destinationTopic, ?string $routingKey = null): self
    {
        return new self($destinationTopic, $routingKey);
    }

    /**
     * @param Topic       $destinationTopic The topic to which the binding is going
     * @param string|null $routingKey       Binding Key
     */
    private function __construct(Topic $destinationTopic, ?string $routingKey = null)
    {
        $this->destinationTopic = $destinationTopic;
        $this->routingKey       = $routingKey;
    }
}
