<?php

/**
 * PHP Service Bus (publish-subscribe pattern) transport common parts
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\InMemory;

use ServiceBus\Transport\Common\Queue;

/**
 *
 */
final class InMemoryQueue implements Queue
{
    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return __CLASS__;
    }

}
