<?php
/**
 * Main application file
 *
 * Whole app design follows 12 factor methodology
 * @see http://12factor.net/
 *
 * This app is PSR1, PSR2, PSR3, PSR4 and PSR7 compliant
 * For more information about the standards see the following links
 * @see http://www.php-fig.org/psr/psr-1/
 * @see http://www.php-fig.org/psr/psr-2/
 * @see http://www.php-fig.org/psr/psr-3/
 * @see http://www.php-fig.org/psr/psr-4/
 * @see http://www.php-fig.org/psr/psr-7/
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

use Zend\Diactoros\Server;

// Hotfix for php 5.6
date_default_timezone_set("Europe/Prague");

// composer autoloader
require_once __DIR__ . '/../vendor/autoload.php';

// Load environment file
require_once __DIR__ . '/../app/environment.php';

// includes error handler
require_once __DIR__ . '/../app/errors.php';



// includes DI container
$container = require_once __DIR__ . '/../app/container.php';
$container->get(Server::class)->listen();

