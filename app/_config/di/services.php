<?php

/**
 * Defines other useful services such as caching, event dispatching etc.
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Service classes and interfaces
 */

/**
 * Aura.Router classes
 * @see http://auraphp.com/packages/Aura.Router/
 */
use Aura\Router\{Map, Matcher, Generator, RouterContainer};

use Stash\Interfaces\PoolInterface;
use League\Flysystem\MountManager;
use League\Event\Emitter;
use Clockwork\Clockwork;
use AdamWathan\Form\FormBuilder;
use Latte\Engine;
use PommProject\Foundation\Pomm;
use Spot\Locator;
use League\Monga\Database;
use Gaufrette\Filesystem;

/**
 * Middleware dispatcher
 * @see http://relayphp.com/
 */
use Relay\Relay;

/**
 * @see http://www.php-fig.org/psr/psr-3/
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\{Log\LoggerInterface, Http\Message\RequestInterface};

return [

    RequestInterface::class => DI\factory('App\Factory\request'),

    /**
     * PSR-7 Middleware dispatcher
     * @see http://relayphp.com/
     */
    Relay::class => DI\factory('App\Factory\relay'),

    /**
     * PSR-7 router
     * @see http://auraphp.com/packages/Aura.Router/
     */

    Map::class => DI\factory('App\Factory\auraRouterMap'),
    Matcher::class => DI\factory('App\Factory\auraRouterMatcher'),
    Generator::class => DI\factory('App\Factory\auraUrlGenerator'),
    RouterContainer::class => DI\factory('App\Factory\auraRoterContainer'),

    /**
     * Caching library
     * @see http://www.stashphp.com/
     */
    PoolInterface::class => DI\factory('App\Factory\stash'),

    /**
     * Flysystem - filesystem abstraction
     * @see http://flysystem.thephpleague.com/
     */
    MountManager::class => DI\factory('App\Factory\flysystem'),

    /**
     * Gaufrette
     * @see
     */
    Filesystem::class => DI\factory('App\Factory\gaufrette'),

    /**
     * Event emitter
     * @see http://event.thephpleague.com/2.0/
     */
    Emitter::class => DI\factory('App\Factory\eventEmitter'),

    /**
     * Clockwork
     * @see https://github.com/itsgoingd/clockwork
     */
    Clockwork::class => DI\factory('App\Factory\clockwork'),

    /**
     * Form Builder
     * @see https://github.com/adamwathan/form
     *
     * @todo replace with former @see http://formers.github.io/former/ (when possible)
     */
    FormBuilder::class => DI\factory('App\Factory\FormBuilder'),

    /**
     * Latte templating engine
     * @see http://latte.nette.org/en/
     */
    Engine::class => DI\factory('App\Factory\latte'),

    /**
    * Swift mailer
    * @see http://swiftmailer.org
    */
    Swift_Mailer::class => DI\factory('App\Factory\swiftMailer'),

    /**
     * Php mailer
     * @see https://github.com/PHPMailer/PHPMailer
     */
    PHPMailer::class => DI\factory('App\Factory\phpMailer'),

    /**
     * SQL database engines
     */

    /**
     * Pomm is the default one
     * @see http://www.pomm-project.org/
     */
    Pomm::class => DI\factory('App\Factory\pomm'),

    /**
     * DIBI
     * @see http://dibiphp.com/
     */
    DibiConnection::class => DI\factory('App\Factory\dibi'),

    /**
     * Spot2
     * @see http://phpdatamapper.com/
     */
    Locator::class => DI\factory('App\Factory\spot2'),

    /**
     * NoSql database engines
     */

    /**
     * Monga
     * @see https://github.com/thephpleague/monga
     */
    Database::class => DI\factory('App\Factory\monga'),

    /**
     * @see https://github.com/Seldaek/monolog
     */
    LoggerInterface::class => DI\factory('App\Factory\monolog'),
];
