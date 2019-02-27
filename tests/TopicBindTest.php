<?php

/**
 * Common transport implementation interfaces.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\Tests;

use PHPUnit\Framework\TestCase;
use ServiceBus\Transport\Common\Topic;
use ServiceBus\Transport\Common\TopicBind;

/**
 *
 */
final class TopicBindTest extends TestCase
{
    /**
     * @test
     *
     * @throws \Throwable
     *
     * @return void
     */
    public function create(): void
    {
        $topic = new class() implements Topic
        {
            public function __toString(): string
            {
                return 'qwerty';
            }
        };

        $bind = TopicBind::create($topic, 'key');

        static::assertSame('qwerty', (string) $bind->destinationTopic);
        static::assertSame('key', $bind->routingKey);
    }
}
