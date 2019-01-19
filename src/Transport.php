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

use Amp\Promise;
use ServiceBus\Transport\Common\Package\OutboundPackage;

/**
 * Messages transport interface
 */
interface Transport
{
    public const SERVICE_BUS_TRACE_HEADER = 'X-SERVICE-BUS-TRACE-ID';
    public const SERVICE_BUS_SERIALIZER_HEADER = 'X-SERVICE-BUS-ENCODER';

    /**
     * Create topic and bind them
     * If the topic to which we binds does not exist, it will be created
     *
     * @param Topic     $topic
     * @param TopicBind ...$binds
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\ConnectionFail Connection refused
     * @throws \ServiceBus\Transport\Common\Exceptions\CreateTopicFailed Failed to create topic
     * @throws \ServiceBus\Transport\Common\Exceptions\BindFailed Failed topic bind
     */
    public function createTopic(Topic $topic, TopicBind ...$binds): Promise;

    /**
     * Create queue and bind to topic(s)
     * If the topic to which we binds does not exist, it will be created
     *
     * @param Queue     $queue
     * @param QueueBind ...$binds
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\ConnectionFail Connection refused
     * @throws \ServiceBus\Transport\Common\Exceptions\CreateQueueFailed Failed to create queue
     * @throws \ServiceBus\Transport\Common\Exceptions\BindFailed Failed queue bind
     */
    public function createQueue(Queue $queue, QueueBind ...$binds): Promise;

    /**
     * Consume to queue
     *
     * @param Queue $queue
     *
     * @return Promise<\Amp\Iterator<\ServiceBus\Transport\Common\Package\IncomingPackage>>
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\ConnectionFail Connection refused
     */
    public function consume(Queue $queue): Promise;

    /**
     * Stop subscription
     *
     * @param Queue $queue
     *
     * @return Promise It does not return any result
     */
    public function stop(Queue $queue): Promise;

    /**
     * Send message to broker
     *
     * @param OutboundPackage $outboundPackage
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\SendMessageFailed Failed to send message
     */
    public function send(OutboundPackage $outboundPackage): Promise;

    /**
     * Connect to broker
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\ConnectionFail Connection refused
     */
    public function connect(): Promise;

    /**
     * Close connection
     *
     * @return Promise It does not return any result
     */
    public function disconnect(): Promise;
}
