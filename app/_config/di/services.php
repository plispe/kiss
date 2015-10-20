<?php

/**
 * Defines other useful services such as caching, event dispatching etc.
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Service classes and interfaces
 */
use Stash\Interfaces\PoolInterface;
use League\Flysystem\MountManager;
use League\Event\Emitter;
use Clockwork\Clockwork;
use AdamWathan\Form\FormBuilder;
use Latte\Engine;
use PommProject\Foundation\Pomm;
use Spot\Locator;
use League\Monga\Database;

/**
 * Middleware dispatcher
 * @see http://relayphp.com/
 */
use Relay\Relay;

/**
 * Aura.Router classes
 * @see http://auraphp.com/packages/Aura.Router/
 */

use Aura\Router\{Map, Matcher, Generator, RouterContainer};

/**
 * Used factories
 */

use App\Factory\{
    Cache\Stash,
    Event\League,
    Devtool\Clockwork as ClockworkFactory,
    Filesystem\Flysystem,
    Html\Form,
    Mailer\SwiftMailer, Mailer\PhpMailer,
    Template\Latte,
    NoSql\Monga,
    Logger\Monolog
};

use App\Factory\Database\Sql\{
    Pomm as PommFactory, Dibi, Spot2
};

use App\Factory\Http\{
    Psr7, Relay as RelayFactory, Router
};

use Psr\{Log\LoggerInterface, Http\Message\RequestInterface};

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [

    RequestInterface::class => DI\factory([Psr7::class, 'createRequest']),

    /**
     * PSR-7 Middleware dispatcher
     * @see http://relayphp.com/
     */
    Relay::class => DI\factory([RelayFactory::class, 'create']),

    /**
     * PSR-7 router
     * @see http://auraphp.com/packages/Aura.Router/
     */

    Map::class => DI\factory([Router::class, 'createMap']),
    Matcher::class => DI\factory([Router::class, 'createMatcher']),
    Generator::class => DI\factory([Router::class, 'createGenerator']),
    RouterContainer::class => DI\factory([Router::class, 'createRouterContainer']),

    /**
     * Caching library
     * @see http://www.stashphp.com/
     */
    PoolInterface::class => DI\factory([Stash::class, 'create']),

    /**
     * Flysystem - filesystem abstraction
     * @see http://flysystem.thephpleague.com/
     */
    MountManager::class => DI\factory([Flysystem::class, 'create']),

    /**
     * Event emitter
     * @see http://event.thephpleague.com/2.0/
     */
    Emitter::class => DI\factory([League::class, 'create']),

    /**
     * Clockwork
     * @see https://github.com/itsgoingd/clockwork
     */
    Clockwork::class => DI\factory([ClockworkFactory::class, 'create']),

    /**
     * Form Builder
     * @see https://github.com/adamwathan/form
     *
     * @todo replace with former @see http://formers.github.io/former/ (when possible)
     */
    FormBuilder::class => DI\factory([Form::class, 'create']),

    /**
     * Latte templating engine
     * @see http://latte.nette.org/en/
     */
    Engine::class => DI\factory([Latte::class, 'create']),

    /**
    * Swift mailer
    * @see http://swiftmailer.org
    */
    Swift_Mailer::class => DI\factory([SwiftMailer::class, 'create']),

    /**
     * Php mailer
     * @see https://github.com/PHPMailer/PHPMailer
     */
    PHPMailer::class => DI\factory([PhpMailer::class, 'create']),

    /**
     * SQL database engines
     */

    /**
     * Pomm is the default one
     * @see http://www.pomm-project.org/
     */
    Pomm::class => DI\factory([PommFactory::class, 'create']),

    /**
     * DIBI
     * @see http://dibiphp.com/
     */
    DibiConnection::class => DI\factory([Dibi::class, 'create']),

    /**
     * Spot2
     * @see http://phpdatamapper.com/
     */
    Locator::class => DI\factory([Spot2::class, 'create']),

    /**
     * NoSql database engines
     */

    /**
     * Monga
     * @see https://github.com/thephpleague/monga
     */
    Database::class => DI\factory([Monga::class, 'create']),

    LoggerInterface::class => DI\Factory([Monolog::class, 'create']),
];
