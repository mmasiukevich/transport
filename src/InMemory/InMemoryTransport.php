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
use Amp\Emitter;
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
     * @var Emitter
     */
    private $emitter;

    public function __construct()
    {
        $this->emitter = new Emitter();
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
    public function consume(Queue ...$queue): Promise
    {
        $emitter = new Emitter();

        /** @psalm-suppress InvalidArgument Incorrect psalm unpack parameters (...$args) */
        return call(
            function() use ($emitter): \Generator
            {
                if (true === InMemoryMessageBus::instance()->has())
                {
                    yield $emitter->emit(InMemoryMessageBus::instance()->extract());
                }

                return $emitter->iterate();
            }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function stop(): Promise
    {
        Loop::stop();

        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function send(OutboundPackage $outboundPackage): Promise
    {
        return $this->emitter->emit(new InMemoryIncomingPackage($outboundPackage->payload, $outboundPackage->headers));
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
