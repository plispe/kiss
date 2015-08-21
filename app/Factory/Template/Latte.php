<?php

/**
 * Latte templating engine PHP-DI factory
 *
 * @see http://latte.nette.org/en/
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Template;

use Latte\Engine;
use Interop\Container\ContainerInterface;

class Latte
{
    /**
     * @param ContainerInterface $c
     * @return Engine
     */
    public function create(ContainerInterface $c)
    {
        $engine = new Engine;

        if (getenv('USE_LATTE_CACHE') === 'true') {
            $engine->setTempDirectory($c->get('latte.cache.dir'));
        }

        return $engine;
    }
}
