<?php

/**
 * Common transport implementation interfaces
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common;

/**
 * Queue interface
 */
interface Queue
{
    /**
     * Return queue name
     *
     * @return string
     */
    public function __toString(): string;
}
