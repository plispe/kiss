<?php

/**
 * Pomm class for Commnad line utility
 * @see http://www.pomm-project.org/documentation/sandbox2
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
use PommProject\Foundation\Pomm;

$container = require_once __DIR__ . '/app/bootstrap.php';
return $container->get(Pomm::class);
