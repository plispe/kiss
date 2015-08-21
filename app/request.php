<?php

/**
 * Creates PSR-7 request
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

use Zend\Diactoros\ServerRequestFactory;

$request =  ServerRequestFactory::fromGlobals();

return $request;
