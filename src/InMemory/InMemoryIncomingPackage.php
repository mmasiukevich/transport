<?php

/**
 * Common transport implementation interfaces
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\InMemory;

use Amp\Promise;
use Amp\Success;
use ServiceBus\Transport\Common\DeliveryDestination;
use ServiceBus\Transport\Common\Package\IncomingPackage;

/**
 *
 */
final class InMemoryIncomingPackage implements IncomingPackage
{
    /**
     * @var string
     */
    private $payload;

    /**
     * @var array<string, string|int|float>
     */
    private $headers;

    /**
     * @param string                          $payload
     * @param array<string, string|int|float> $headers
     */
    public function __construct(string $payload, array $headers)
    {
        $this->payload = $payload;
        $this->headers = $headers;
    }

    /**
     * @inheritDoc
     */
    public function id(): string
    {
        return \sha1((string) \microtime());
    }

    /**
     * @inheritDoc
     */
    public function time(): float
    {
        return \time();
    }

    /**
     * @inheritDoc
     */
    public function origin(): DeliveryDestination
    {
        return new InMemoryDeliveryDestination();
    }

    /**
     * @inheritDoc
     */
    public function payload(): string
    {
        return $this->payload;
    }

    /**
     * @inheritDoc
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * @inheritDoc
     */
    public function ack(): Promise
    {
        return new Success();
    }

    /**
     * @inheritDoc
     */
    public function nack(bool $requeue, ?string $withReason = null): Promise
    {
        return new Success();
    }

    /**
     * @inheritDoc
     */
    public function reject(bool $requeue, ?string $withReason = null): Promise
    {
        return new Success();
    }

    /**
     * @inheritDoc
     */
    public function traceId(): string
    {
        return \sha1((string) \microtime());
    }
}
