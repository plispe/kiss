<?php

namespace App\Shared\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{UriInterface};

/**
 * @see http://auraphp.com/packages/Aura.Router/generating-paths.html#2.4
 */
use Aura\Router\Generator;

/**
 * @see  http://tactician.thephpleague.com/
 */
use League\Tactician\CommandBus;

/**
 * Simple abstract controller
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
abstract class AbstractController
{
    /**
     * @inject
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @inject
     * @var Generator
     */
    protected $uriGenerator;

    /**
     * @param  string
     * @param  array
     * @return UriInterface
     */
    public function link(string $routeName, array $params): UriInterface
    {
        return $this->generator->generate($routeName, $params);
    }
}
