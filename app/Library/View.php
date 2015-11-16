<?php

namespace App\Library;

/**
 * @author  Petr Pliska <petr.pliska@post.cz>
 */

/**
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\HtmlResponse;

class View
{
    /**
     * @var array
     */
    protected $engines = [];

    /**
     * @var array
     */
    protected $params = [];

    /**
     * Render template with variables
     *
     * @param  string $template
     * @param  array $params
     */
    public function render(string $template, array $params = []): HtmlResponse
    {
        // get extension of template file
        $ext = sprintf('.%s', pathinfo($template, PATHINFO_EXTENSION));

        // if template exngine for current file extension not exists
        if (! isset($this->engines[$ext])) {
            throw new \Exception(sprintf('Teplate engine for files with extensions "%s" is not provided.', $ext));
        }

        // call render callback for engine
        return $this->engines[$ext]($template, array_merge($this->params, $params));
    }

    /**
     * Register new template engine
     * @param  string $fileExtension
     * @param  callable $renderCallback
     */
    public function registerTemplateEngine(string $fileExtension, callable $renderCallback)
    {
        $this->engines[$fileExtension] = $renderCallback;
    }

    /**
     * Set template variable
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set(string $name, $value)
    {
        $this->params[$name] = $value;
    }
}
