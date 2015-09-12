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

use Relay\Relay;
use Zend\Diactoros\Server;
use Clockwork\Clockwork;
use Clockwork\Request\Timeline;
use Psr\Http\Message\RequestInterface;

/**
 * Index file
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/******************************************************************************/
/*                        COMPOSER AUTOLOADING START                          */
/******************************************************************************/

require_once __DIR__ . '/../vendor/autoload.php';

// Clockwork time measuring
$timeline = new Timeline;

// composer autoloading duration calculated from begin of request
$timeline->startEvent(
    'composer',
    'Composer autoloading',
    $_SERVER['REQUEST_TIME_FLOAT']
);

// end of composer event
$timeline->endEvent('composer');

/******************************************************************************/
/*                        COMPOSER AUTOLOADING END                            */
/******************************************************************************/

/******************************************************************************/
/*                        .ENV PARSING START                                  */
/******************************************************************************/

// start of env event
$timeline->startEvent('env', 'Parsing .env file');

require_once __DIR__ . '/../app/environment.php';

// end of env event
$timeline->endEvent('env');

/******************************************************************************/
/*                        .ENV PARSING END                                    */
/******************************************************************************/

/******************************************************************************/
/*                        INIT OF ERROR HANDLER START                         */
/******************************************************************************/

// start of errorHandler event
$timeline->startEvent('errorHandler', 'Init error handler');

// includes error handler
require_once __DIR__ . '/../app/errors.php';

// end of errorHandler event
$timeline->endEvent('errorHandler');

/******************************************************************************/
/*                        INIT OF ERROR HANDLER END                           */
/******************************************************************************/

/******************************************************************************/
/*                        INIT OF DI CONTAINER START                          */
/******************************************************************************/

// start of container event
$timeline->startEvent('container', 'Init of DI container');

// includes DI container
$container = require_once __DIR__ . '/../app/container.php';

// end of container event
$timeline->endEvent('container');

/******************************************************************************/
/*                        INIT OF DI CONTAINER END                            */
/******************************************************************************/

/******************************************************************************/
/*                        INIT OF ZEND DIACTOROS SERVER                       */
/******************************************************************************/

// start of server event
$timeline->startEvent('server', 'Init of Zend diactoros server');

// Set existing timeline to clockwork in DI container
$container->get(Clockwork::class)->setTimeline($timeline);

// Zend Diactoros server
$server = Server::createServerfromRequest(
    $container->get(Relay::class),
    $container->get(RequestInterface::class)
);

// Listening to request
$server->listen();

/******************************************************************************/
/*                        END OF APPLICATION                                  */
/******************************************************************************/
