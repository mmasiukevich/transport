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

use ServiceBus\Transport\Common\DeliveryDestination;

/**
 * Outbound package
 *
 * @property-read string                          $payload
 * @property-read array<string, string|int|float> $headers
 * @property-read DeliveryDestination             $destination
 * @property-read bool                            $persistentFlag
 * @property-read bool                            $mandatoryFlag
 * @property-read bool                            $immediateFlag
 * @property-read int|null                        $expiredAfter
 * @property-read string|int                      $traceId
 */
class OutboundPackage
{
    /**
     * Message body
     *
     * @var string
     */
    public $payload;

    /**
     * Message headers
     *
     * @var array<string, string|int|float>
     */
    public $headers;

    /**
     * Message destination
     *
     * @var DeliveryDestination
     */
    public $destination;

    /**
     * The message must be stored in the broker
     *
     * @var bool
     */
    public $persistentFlag = false;

    /**
     * The message must be sent to the existing recipient
     *
     * @var bool
     */
    public $mandatoryFlag = false;

    /**
     * The message will be sent with the highest priority
     *
     * @var bool
     */
    public $immediateFlag = false;

    /**
     * The message will be marked expired after N milliseconds
     *
     * @var int|null
     */
    public $expiredAfter;

    /**
     * Trace operation id
     *
     * @var string|int
     */
    public $traceId;

    /**
     * @param string                          $payload
     * @param array<string, string|int|float> $headers
     * @param DeliveryDestination             $destination
     * @param string|int                      $traceId
     * @param bool                            $persist
     * @param bool                            $mandatory
     * @param bool                            $immediate
     * @param int|null                        $expiredAfter
     *
     * @return static
     */
    public static function create(
        string $payload,
        array $headers,
        DeliveryDestination $destination,
        $traceId,
        bool $persist = false,
        bool $mandatory = false,
        bool $immediate = false,
        ?int $expiredAfter = null
    ): self
    {
        return new static($payload, $headers, $destination, $traceId, $persist, $mandatory, $immediate, $expiredAfter);
    }

    /**
     * @param string                          $payload
     * @param array<string, string|int|float> $headers
     * @param DeliveryDestination             $destination
     * @param string|int                      $traceId
     * @param bool                            $persist
     * @param bool                            $mandatory
     * @param bool                            $immediate
     * @param int|null                        $expiredAfter
     */
    private function __construct(
        string $payload,
        array $headers,
        DeliveryDestination $destination,
        $traceId,
        bool $persist = false,
        bool $mandatory = false,
        bool $immediate = false,
        ?int $expiredAfter = null
    )
    {
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
