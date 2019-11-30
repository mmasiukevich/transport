<?php

/**
 * Common transport implementation interfaces.
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\Package;

use ServiceBus\Transport\Common\DeliveryDestination;

/**
 * Outbound package.
 *
 * @psalm-readonly
 */
class OutboundPackage
{
    /**
     * Message body.
     */
    public string $payload;

    /**
     * Message headers.
     *
     * @psalm-var array<string, float|int|string>
     */
    public array

 $headers;

    /**
     * Message destination.
     */
    public DeliveryDestination $destination;

    /**
     * The message must be stored in the broker.
     */
    public bool $persistentFlag = false;

    /**
     * This flag tells the server how to react if the message cannot be routed to a queue. If this flag is set, the
     * server will return an unroutable message with a Return method. If this flag is zero, the server silently drops
     * the message.
     */
    public bool $mandatoryFlag = false;

    /**
     * This flag tells the server how to react if the message cannot be routed to a queue consumer immediately. If this
     * flag is set, the server will return an undeliverable message with a Return method. If this flag is zero, the
     * server will queue the message, but with no guarantee that it will ever be consumed.
     */
    public bool $immediateFlag = false;

    /**
     * The message will be marked expired after N milliseconds.
     */
    public ?int $expiredAfter;

    /**
     * Trace operation id.
     *
     * @var int|string|null
     */
    public $traceId;

    /**
     * @psalm-param array<string, float|int|string> $headers
     *
     * @param int|string|null     $traceId
     */
    public function __construct(
        string $payload,
        array $headers,
        DeliveryDestination $destination,
        $traceId,
        bool $persist = false,
        bool $mandatory = false,
        bool $immediate = false,
        ?int $expiredAfter = null
    ) {
        $this->payload        = $payload;
        $this->headers        = $headers;
        $this->destination    = $destination;
        $this->traceId        = $traceId;
        $this->persistentFlag = $persist;
        $this->mandatoryFlag  = $mandatory;
        $this->immediateFlag  = $immediate;
        $this->expiredAfter   = $expiredAfter;
    }
}
