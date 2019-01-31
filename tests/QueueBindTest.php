<?php

/**
 * Common transport implementation interfaces
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\QueueBindTest;

use PHPUnit\Framework\TestCase;
use ServiceBus\Transport\Common\QueueBind;
use ServiceBus\Transport\Common\Topic;

/**
 *
 */
final class QueueBindTest extends TestCase
{
    /**
     * @test
     *
     * @return void
     *
     * @throws \Throwable
     */
    public function create(): void
    {
        $topic = new class implements Topic
        {
            public function __toString(): string
            {
                return 'qwerty';
            }
        };

        $bind = QueueBind::create($topic, 'key');

        static::assertEquals('qwerty', (string) $bind->destinationTopic);
        static::assertEquals('key', $bind->routingKey);
    }
}
