<?php

/**
 * Common transport implementation interfaces
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\Package;

use Amp\Promise;
use ServiceBus\Transport\Common\DeliveryDestination;

/**
 * Incoming package
 */
interface IncomingPackage
{
    /**
     * Receive package id
     *
     * @return string
     */
    public function id(): string;

    /**
     * Receive Unix timestamp with microseconds (the time the message was received)
     *
     * @return float
     */
    public function time(): float;

    /**
     * The source from which the message was received
     *
     * @return DeliveryDestination
     */
    public function origin(): DeliveryDestination;

    /**
     * Receive message body
     *
     * @return string
     */
    public function payload(): string;

    /**
     * Receive message headers bag
     *
     * @return array<string, string|int|float>
     */
    public function headers(): array;

    /**
     * Acks given message
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\AcknowledgeFailed
     */
    public function ack(): Promise;

    /**
     * Nacks message
     *
     * @param bool        $requeue    Send back to the queue
     * @param null|string $withReason Reason for refusal
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\NotAcknowledgeFailed
     */
    public function nack(bool $requeue, ?string $withReason = null): Promise;

    /**
     * Rejects message
     *
     * @param bool        $requeue    Send back to the queue
     * @param null|string $withReason Reason for refusal
     *
     * @return Promise It does not return any result
     *
     * @throws \ServiceBus\Transport\Common\Exceptions\RejectFailed
     */
    public function reject(bool $requeue, ?string $withReason = null): Promise;

    /**
     * Receive trace id
     *
     * @return string|int
     */
    public function traceId();
}
