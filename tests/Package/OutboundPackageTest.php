<?php

/**
 * PHP Service Bus transport common parts
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\Tests\Package;

use PHPUnit\Framework\TestCase;
use ServiceBus\Transport\Common\DeliveryDestination;
use ServiceBus\Transport\Common\Package\OutboundPackage;

/**
 *
 */
class OutboundPackageTest extends TestCase
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
        $destination = new class implements DeliveryDestination
        {

        };

        $package = OutboundPackage::create('payloadData', ['key' => 'value'], $destination, 'traceId');

        static::assertEquals('payloadData', $package->payload);
        static::assertEquals(['key' => 'value'], $package->headers);
        static::assertEquals($destination, $package->destination);
        static::assertEquals('traceId', $package->traceId);
    }
}
