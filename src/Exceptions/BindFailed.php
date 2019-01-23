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
 * Bind operation failed
 */
final class BindFailed extends \RuntimeException implements TransportFail
{

}
