<?php

/**
 * Defines helper method for latte template rendering
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Behaviour\Controller\View;

use Zend\Diactoros\Response\HtmlResponse;

trait LatteTrait
{
    /**
     * @Inject
     * @var Latte\Engine
     */
    protected $templateEngine;

    /**
     * @Inject("templates.dir")
     */
    protected $templatesDir;

    /**
     * @param String $view
     * @param array $params
     *
     * @return HtmlResponse
     */
    public function renderLatte($view, array $params = [])
    {
        // Path to template
        $viewPath = sprintf('%s%s.latte', $this->templatesDir, $view);
         // Output HTML
        $html     = $this->templateEngine->renderToString($viewPath, $params);
        // HTML response
        $response = new HtmlResponse($html);

        return $response;
    }
}
