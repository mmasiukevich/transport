<?php

/**
 * Common transport implementation interfaces
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

        $bind = TopicBind::create($topic, 'key');

        static::assertEquals('qwerty', (string) $bind->destinationTopic);
        static::assertEquals('key', $bind->routingKey);
    }
}