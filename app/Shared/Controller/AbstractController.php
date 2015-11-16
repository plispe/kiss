<?php

namespace App\Shared\Controller;

use Psr\Log\LoggerInterface;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface, UriInterface};

/**
 * @see http://symfony.com/doc/current/components/http_kernel/introduction.html
 */
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Zend implementation of PSR-7
 * @see https://github.com/zendframework/zend-diactoros
 */
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response\RedirectResponse;

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
     * @injectd
     * @var CommandBus
     */
    protected $commandBus;

    /**
     * @Inject
     * @var Generator
     */
    protected $uriGenerator;

    /**
     * Helper for calling controller action
     *
     * @param String $actionName
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function callAction(string $actionName, RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        // Method not exists
        if (! method_exists($this, $actionName)) {
            throw new NotFoundHttpException(sprintf('Action "%s" not exists.', $actionName));
        }

        // Action call
        return $this->$actionName($request, $response);
    }

    /**
     * @param  string
     * @param  int|integer
     */
    public function redirect(string $url, int $code = 301)
    {
        (new SapiEmitter)->emit(new RedirectResponse($url, $code));
        die;
    }

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
