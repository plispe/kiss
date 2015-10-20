<?php

/**
 * Pomm class for Commnad line utility
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
