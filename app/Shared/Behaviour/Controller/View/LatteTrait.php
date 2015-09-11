<?php

/**
 * Defines helper method for latte template rendering
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Behaviour\Controller\View;

/**
 * Form Builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

use Underscore\Types\Arrays;
use Zend\Diactoros\Response\HtmlResponse;

trait LatteTrait
{
    /**
     * @Inject
     * @var AdamWathan\Form\FormBuilder
     */
    protected $formBuilder;

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
        $params = Arrays::merge($params, ['builder' => $this->formBuilder]);
        // Path to template
        $viewPath = sprintf('%s%s.latte', $this->templatesDir, $view);
         // Output HTML
        $html     = $this->templateEngine->renderToString($viewPath, $params);
        // HTML response
        $response = new HtmlResponse($html);

        return $response;
    }
}
