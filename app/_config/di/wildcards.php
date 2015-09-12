<?php

/**
 * @see http://php-di.org/doc/php-definitions.html#wildcards
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

return [
    /**
     * Middleware wildcard
     */
    '\App\Shared\Middleware\*'   => DI\object('App\Shared\Middleware\*'),

    /**
     * Controller wildcards
     */
    '\App\Module\Web\Controller\*'   => DI\object('\App\Module\Web\Controller\*'),
    '\App\Module\Api\Controller\*'   => DI\object('\App\Module\Api\Controller\*'),
    '\App\Module\Admin\Controller\*' => DI\object('\App\Module\Admin\Controller\*'),
];
