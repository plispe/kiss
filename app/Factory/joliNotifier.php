<?php

namespace App\Factory;

use \Joli\JoliNotif\{Notifier, Notification, NotifierFactory};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\joliNotifier')) {
    function joliNotifier(ContainerInterface $c) {
        return $notifier = NotifierFactory::create();
    }
}
