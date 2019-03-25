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

use function Amp\call;
use Amp\Loop;
use Amp\Promise;
use Amp\Success;
use ServiceBus\Transport\Common\Package\OutboundPackage;
use ServiceBus\Transport\Common\Queue;
use ServiceBus\Transport\Common\QueueBind;
use ServiceBus\Transport\Common\Topic;
use ServiceBus\Transport\Common\TopicBind;
use ServiceBus\Transport\Common\Transport;

/**
 * In memory transport implementation.
 *
 * For tests only
 *
 * @codeCoverageIgnore
 */
final class InMemoryTransport implements Transport
{
    /**
     * @var string|null
     */
    private $listenerId;

    public function __construct()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function createTopic(Topic $topic, TopicBind ...$binds): Promise
    {
        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function createQueue(Queue $queue, QueueBind ...$binds): Promise
    {
        return new Success();
    }

    /**
     * @psalm-suppress MixedTypeCoercion
     *
     * {@inheritdoc}
     */
    public function consume(callable $onMessage, Queue ... $queues): Promise
    {
        /** @psalm-suppress InvalidArgument Incorrect psalm unpack parameters (...$args) */
        return call(
            function() use ($onMessage): void
            {
                $this->listenerId = Loop::repeat(
                    100,
                    static function() use ($onMessage): \Generator
                    {
                        if(true === InMemoryMessageBus::instance()->has())
                        {
                            /** @var \Generator $generator */
                            $generator = $onMessage(InMemoryMessageBus::instance()->extract());

                            yield from $generator;
                        }
                    }
                );
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stop(): Promise
    {
        if(null !== $this->listenerId)
        {
            Loop::cancel($this->listenerId);
        }

        Loop::stop();

        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function send(OutboundPackage $outboundPackage): Promise
    {
        InMemoryMessageBus::instance()->add(
            new InMemoryIncomingPackage($outboundPackage->payload, $outboundPackage->headers)
        );

        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function connect(): Promise
    {
        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function disconnect(): Promise
    {
        return new Success();
    }
}
