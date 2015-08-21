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
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

/**
 * Symfony exceptions
 */
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


use App\Shared\Behaviour\Common\ClockworkTrait;

class Dispatcher implements MiddlewareInterface
{
    use ClockworkTrait;

    /**
     * @Inject
     * @var DI\Container
     */
    protected $diContainer;

    /**
     * @inheritdoc
     */
    public function __invoke(RequestInterface $request, ResponseInterface $response, callable $next)
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
            $this->endEvent('dispatching');
            $this->startEvent('controller', 'Running controller action');
            // Call controller action
            $response =  $controller->callAction(
                $this->getFullActionName($route->attributes['action']),
                $request,
                $response
            );
            $this->endEvent('controller');
            return $response;
        }
    }

    /**
     * @param String $controllerClass
     *
     * @return Bool
     * @throws NotFoundHttpException
     */
    protected function controllerClassExists($controllerClass)
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
    protected function getFullActionName($action)
    {
        return sprintf('%sAction', $action);
    }

    /**
     * Get real controller class name
     *
     * @param String $module
     * @param String $controller
     */
    protected function getFullControllerName($module, $controller)
    {
        return sprintf(
            '\App\Module\%s\Controller\%sController',
            s($module)->toTitleCase(),
            s($controller)->toTitleCase()
        );
    }
}
