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
if (getenv('USE_DI_CACHE') === 'true') {
    /**
     * PHP DI uses doctrine cache
     * @see http://php-di.org/doc/performances.html
     */
    $cache = new Doctrine\Common\Cache\ApcCache;

    /**
     * Sets cache namespace. usefun when more applications use same cache
     */
    $cache->setNamespace(getenv('APP_NAME'));

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

// Definitions files
$definitionFiles = [
    __DIR__ .'/_config/di/parameters.php',
    __DIR__ .'/_config/di/services.php',
    __DIR__ .'/_config/di/middlewares.php',
];

// Load files into container
foreach ($definitionFiles as $definitions) {
    $containerBuilder->addDefinitions($definitions);
}

// Returns instance of builded container
return $containerBuilder->build();
