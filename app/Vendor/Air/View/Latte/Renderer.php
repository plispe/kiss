<?php

namespace App\Vendor\Air\View\Latte;

/**
 * Latte templating engine
 * @see https://latte.nette.org/cs/
 */
use Latte\Engine;

/**
 * Class LatteRenderer
 * @package App\Vendor\Air\View
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Renderer extends \Air\View\Renderer
{
    /**
     * @var Engine
     */
    protected $engine;

    /**
     * @param string|null $cacheDir A directory to cache rendered templates into (enables caching).
     * @param string|null $partialsDir A directory where static partials are stored.
     */
    public function __construct($cacheDir = null, $partialsDir = null)
    {
        $this->engine = (new Engine)->setTempDirectory($cacheDir);
    }

    /**
     * @param string $file The file to load.
     * @param array $data The data to inject.
     * @return string The rendered output.
     */
    public function render($file, array $data)
    {
        return $this->engine->renderToString($file, $data);
    }
}
