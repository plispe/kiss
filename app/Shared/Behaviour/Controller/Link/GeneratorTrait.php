<?php

/**
 * Define helper method for link generating
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Shared\Behaviour\Controller\Link;

/**
 * @see http://auraphp.com/packages/Aura.Router/generating-paths.html#2.4
 */
use Aura\Router\Generator;
use Underscore\Types\Arrays;
use Psr\Http\RequestInterface;

trait GeneratorTrait
{
    /**
     * @Inject
     * @var Aura\Router\Generator
     */
    protected $generator;

    /**
     * @param String routeName
     * @param array $params
     * @param Bool $absolute
     *
     * @return String
     */
    public function link($routeName, array $params = [], $absolute)
    {
        $defaultParams = [
            'action' => null
        ];

        $params = Arrays::merge($defaultParams, $params);

        return $this->generator->generate($routeName, $params);
    }
}
