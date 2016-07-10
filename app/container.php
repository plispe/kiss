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
    $cache = new Doctrine\Common\Cache\ApcuCache;

    /*
     * Sets cache namespace. usefun when more applications use same cache
     */
    $cache->setNamespace(getenv('PHPDI_CACHE_NAMESPACE'));

    /*
     * Sets cache definition file
     */
    $containerBuilder->setDefinitionCache($cache);
}

/*
 * Using annotations for dependency injection
 * Ignores error if phpdoc is invalid
 */
$containerBuilder
    ->useAnnotations(true)
    ->ignorePhpDocErrors(true)
    ->writeProxiesToFile(true, __DIR__ .'/../temp/proxies');

/*
 * Service definitions
 */
$containerBuilder
    ->addDefinitions(__DIR__ .'/_config/di/parameters.php')
    ->addDefinitions(__DIR__ .'/_config/di/middlewares.php')
    ->addDefinitions((new \App\ServiceProvider\Server)->getServices())
    ->addDefinitions((new \App\ServiceProvider\Monolog)->getServices())
    ->addDefinitions((new \App\ServiceProvider\AuraRouter)->getServices())
    ->addDefinitions((new \App\ServiceProvider\Latte)->getServices())
    ->addDefinitions((new \App\ServiceProvider\CommandBus)->getServices())
    ->addDefinitions((new \App\ServiceProvider\Bernard)->getServices());

// Returns instance of builded container
return $containerBuilder->build();
