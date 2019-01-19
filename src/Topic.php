<?php

/**
 * PHP Service Bus (publish-subscribe pattern) transport common parts
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common;

/**
 * Topic interface
 */
interface Topic
{
    /**
     * Return topic name
     *
     * @return string
     */
    public function __toString(): string;
}
