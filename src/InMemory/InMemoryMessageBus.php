<?php

/**
 * PHP Service Bus (publish-subscribe pattern) transport common parts
 *
 * @author  Maksim Masiukevich <dev@async-php.com>
 * @license MIT
 * @license https://opensource.org/licenses/MIT
 */

declare(strict_types = 1);

namespace ServiceBus\Transport\Common\InMemory;

/**
 * @internal
 */
final class InMemoryMessageBus
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var \SplQueue<\ServiceBus\Transport\Common\InMemory\InMemoryIncomingPackage>
     */
    private $messages;

    /**
     * @return InMemoryMessageBus
     */
    public static function instance(): InMemoryMessageBus
    {
        if(null === self::$instance)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @param InMemoryIncomingPackage $package
     *
     * @return void
     */
    public function add(InMemoryIncomingPackage $package): void
    {
        $this->messages->push($package);
    }

    /**
     * @return bool
     */
    public function has(): bool
    {
        return 0 !== $this->messages->count();
    }

    /**
     * @return InMemoryIncomingPackage
     */
    public function extract(): InMemoryIncomingPackage
    {
        /** @var InMemoryIncomingPackage $package */
        $package = $this->messages->current();

        return $package;
    }

    private function __clone()
    {

    }

    private function __construct()
    {
        $this->messages = new \SplQueue();
    }
}
