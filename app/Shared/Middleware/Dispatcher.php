<?php

/**
 * Dispatcher middleware
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Middleware;

/**
 * String manipulation tollbelt
 * @see https://github.com/danielstjules/Stringy#totitlecase
 */
use function Stringy\create as s;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

/**
 * Symfony exceptions
 */
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Own classes and interfaces
 */
use App\Shared\Behaviour\Common\ClockworkTrait;

class Dispatcher implements MiddlewareInterface
{
    use ClockworkTrait;

    /**
     * @inject
     * @var DI\Container
     */
    protected $diContainer;

    /**
     * @inheritdoc
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next): ResponseInterface
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

            $this->endEvent('dispatching');

            $this->startEvent('controller', 'Running controller action');

            // Check existence of controller action
            if (! method_exists($controller, $action)) {
                throw new NotFoundHttpException(sprintf('Controller "%s" has no action "%s".', $controllerClass, $action));
            }
            // Call controller action
            $response = $controller->$action($request, $response);

            $this->endEvent('controller');
            $response = $next($request, $response, $next);
            return $response;
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
     * @param String $module
     * @param String $controller
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
