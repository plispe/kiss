<?php

/**
 * View object factory
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Form Builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

/**
 * Psr7 request
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\RequestInterface;

if (! function_exists('App\Factory\view')) {
    function view(ContainerInterface $c) {
        // Inject dependencies
        return $c->call(function (\Latte\Engine $latte, FormBuilder $builder, RequestInterface $request) use ($c) {
            // Create view object
            $view = new class($c->get('templates.dir')) {
                /**
                 * @var array
                 */
                protected $engines = [];

                /**
                 * @var array
                 */
                protected $params = [];

                /**
                 * Path to templates dir
                 * @var string
                 */
                protected $templatesDir;

                /**
                 * @param string
                 */
                public function __construct(string $templatesDir)
                {
                    $this->templatesDir = $templatesDir;
                }
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

                    // if File not exists, search in template dirs
                    $template = file_exists($template)
                        ? $template
                        : sprintf('%s%s', $this->templatesDir, $template);

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
            };

            /*
               Register tempalte engines
             */
            $view->registerTemplateEngine('.latte', function (string $template, array $params) use ($latte) {
                // Creates html response with rendered html
                return new HtmlResponse($latte->renderToString($template, $params));
            });

            /*
               Set default variables
             */
            $view->builder = $builder;
            $view->request = $request;

            return $view;
        });
    }
}
