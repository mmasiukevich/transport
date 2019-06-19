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
 * Topic interface.
 */
interface Topic
{
    /**
     * @deprecated Will be removed in the next version (use toString() method)
     *
     * Return topic name.
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * Return topic name.
     *
     * @return string
     */
    public function toString(): string;
}
