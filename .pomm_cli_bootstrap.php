<?php

/**
 * Pomm class for Commnad line utility
 *
 * For using pomm please install following compser packages:
 * - "pomm-project/cli"
 * - "pomm-project/foundation"
 * - "pomm-project/model-manager"
 *
 * @see https://github.com/pomm-project/Foundation/blob/master/documentation/foundation.rst
 * @see https://github.com/pomm-project/ModelManager/blob/master/documentation/model_manager.rst
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use PommProject\Foundation\Pomm;

/**
 * PHP-DI container
 */
$container = require_once __DIR__ . '/app/bootstrap.php';

/**
 * Pomm class
 */
return $container->get(Pomm::class);
