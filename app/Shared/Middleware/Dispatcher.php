<?php

namespace App\Shared\Middleware;

/**
 * String manipulation tollbelt
 * @see https://github.com/danielstjules/Stringy#totitlecase
 */
use DI\Container;
use function Stringy\create as s;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Symfony exceptions
 */
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class Dispatcher
 * @package App\Shared\Middleware
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Dispatcher implements MiddlewareInterface
{
    /**
     * @var Container
     */
    protected $diContainer;

    /**
     * Dispatcher constructor.
     * @param Container $diContainer
     */
    public function __construct(Container $diContainer)
    {
        $this->diContainer = $diContainer;
    }

    /**
     * @inheritdoc
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
    {
        $route = $request->getAttribute('route');

        /**
         * Controller Class name
         */
        $controllerClass = $this->getFullControllerName(
            $route->attributes['module'],
            $route->attributes['controller']
        );

        /**
         * Check class existence
         */
        if ($this->controllerClassExists($controllerClass)) {
            // Instance of controller
            $controller = $this->diContainer->get($controllerClass);
            $action = $this->getFullActionName($route->attributes['action']);

            // Check existence of controller action
            if (!method_exists($controller, $action)) {
                throw new NotFoundHttpException(sprintf('Controller "%s" has no action "%s".', $controllerClass, $action));
            }

            // Call controller action
            return $next($request, $controller->$action($request, $response), $next);
        }
    }

    /**
     * @param String $controllerClass
     *
     * @return Bool
     * @throws NotFoundHttpException
     */
    protected function controllerClassExists($controllerClass): bool
    {
        $existence = class_exists($controllerClass);

        if (!$existence) {
            throw new NotFoundHttpException(
                sprintf('Controller class "%s" does not exist', $controllerClass)
            );
        }

        return $existence;
    }

    /**
     * Get real action name, for example indexAction
     *
     * @param String $action
     * @return String
     */
    protected function getFullActionName($action): string
    {
        return sprintf('%sAction', $action);
    }

    /**
     * Get real controller class name
     *
     * @param $module
     * @param $controller
     * @return string
     */
    protected function getFullControllerName($module, $controller): string
    {
        return sprintf(
            '\App\Module\%s\Controller\%sController',
            s($module)->toTitleCase(),
            s($controller)->toTitleCase()
        );
    }
}
