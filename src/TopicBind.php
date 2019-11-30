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
 * @psalm-readonly
 */
class TopicBind
{
    /**
     * The topic to which the binding is going.
     */
    public Topic $destinationTopic;

    /**
     * Binding Key.
     */
    public ?string $routingKey;

    public function __construct(Topic $destinationTopic, ?string $routingKey = null)
    {
        $this->destinationTopic = $destinationTopic;
        $this->routingKey       = $routingKey;
    }
}
