<?php

/**
 * PHP Service Bus transport common parts
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\Exceptions;

/**
 * Error in the message ack process
 */
final class AcknowledgeFailed extends \RuntimeException implements TransportFail
{

}
