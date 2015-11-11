#!/usr/bin/env php
<?php

require_once __DIR__ . '/../vendor/autoload.php';

/**
 * DI container
 * @see http://php-di.org/
 */
$container = require_once __DIR__ . '/../app/container.php';

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

use App\Vendor\Codegyre\Robo\Runner;

$runner = new Runner;
$runner->setDiContainer($container);
$runner->execute();
