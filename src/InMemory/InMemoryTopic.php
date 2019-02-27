<?php

/**
 * Common transport implementation interfaces.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\InMemory;

use ServiceBus\Transport\Common\Topic;

/**
 * For tests only.
 *
 * @codeCoverageIgnore
 */
final class InMemoryTopic implements Topic
{
    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return __CLASS__;
    }
}
