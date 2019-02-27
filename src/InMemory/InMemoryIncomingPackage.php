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

use Amp\Promise;
use Amp\Success;
use ServiceBus\Transport\Common\DeliveryDestination;
use ServiceBus\Transport\Common\Package\IncomingPackage;

/**
 * For tests only.
 *
 * @codeCoverageIgnore
 */
final class InMemoryIncomingPackage implements IncomingPackage
{
    /**
     * @var string
     */
    private $payload;

    /**
     * @psalm-var array<string, string|int|float>
     *
     * @var array
     */
    private $headers;

    /**
     * @psalm-param array<string, string|int|float> $headers
     *
     * @param string $payload
     * @param array  $headers
     */
    public function __construct(string $payload, array $headers)
    {
        $this->payload = $payload;
        $this->headers = $headers;
    }

    /**
     * {@inheritdoc}
     */
    public function id(): string
    {
        return \sha1((string) \microtime());
    }

    /**
     * {@inheritdoc}
     */
    public function time(): float
    {
        return \time();
    }

    /**
     * {@inheritdoc}
     */
    public function origin(): DeliveryDestination
    {
        return new InMemoryDeliveryDestination();
    }

    /**
     * {@inheritdoc}
     */
    public function payload(): string
    {
        return $this->payload;
    }

    /**
     * {@inheritdoc}
     */
    public function headers(): array
    {
        return $this->headers;
    }

    /**
     * {@inheritdoc}
     */
    public function ack(): Promise
    {
        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function nack(bool $requeue, ?string $withReason = null): Promise
    {
        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function reject(bool $requeue, ?string $withReason = null): Promise
    {
        return new Success();
    }

    /**
     * {@inheritdoc}
     */
    public function traceId(): string
    {
        return \sha1((string) \microtime());
    }
}
