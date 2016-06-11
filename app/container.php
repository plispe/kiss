<?php

/**
 * PHP-DI is used as default
 * @see http://php-di.org/
 *
 * But you can chose an another container
 * @see https://github.com/container-interop/container-interop
 * @see https://github.com/jeremeamia/acclimate-container
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * For more information
 * @see http://php-di.org/doc/container-configuration.html
 */
$containerBuilder = new \DI\ContainerBuilder;

// If cache is enabled
if (getenv('USE_PHPDI_CACHE') === 'true') {
    /**
     * PHP DI uses doctrine cache
     * @see http://php-di.org/doc/performances.html
     */
    $cache = new Doctrine\Common\Cache\ApcCache;

    /**
     * Sets cache namespace. usefun when more applications use same cache
     */
    $cache->setNamespace(getenv('PHPDI_CACHE_NAMESPACE'));

    /**
     * Sets cache definition file
     */
    $containerBuilder->setDefinitionCache($cache);
}

/**
 * Using annotations for dependency injection
 */
$containerBuilder->useAnnotations(true);

/**
 * Ignores error if phpdoc is invalid
 */
$containerBuilder->ignorePhpDocErrors(true);

/**
 * Path for proxy mannager
 */
$containerBuilder->writeProxiesToFile(true, __DIR__ .'/../temp/proxies');

/**
 * Service definitions
 */
$containerBuilder->addDefinitions(__DIR__ .'/_config/di/parameters.php');
$containerBuilder->addDefinitions(__DIR__ .'/_config/di/middlewares.php');

/**
 * Service providers
 */
$containerBuilder->addDefinitions((new \App\ServiceProvider\Server)->getServices());
$containerBuilder->addDefinitions((new \App\ServiceProvider\Monolog)->getServices());
$containerBuilder->addDefinitions((new \App\ServiceProvider\AuraRouter)->getServices());
$containerBuilder->addDefinitions((new \App\ServiceProvider\Latte)->getServices());
$containerBuilder->addDefinitions((new \App\ServiceProvider\View)->getServices());
$containerBuilder->addDefinitions((new \App\ServiceProvider\CommandBus)->getServices());

// Returns instance of builded container
return $containerBuilder->build();
