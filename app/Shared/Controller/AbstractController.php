<?php

namespace App\Shared\Controller;

use Psr\Log\LoggerInterface;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

use App\Shared\Behaviour\Controller\Link\GeneratorTrait;

/**
 * Simple abstract controller
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

abstract class AbstractController
{
    /**
     * @Inject
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Helper for url generating
     */
    use GeneratorTrait;

    /**
     * Beforea action hoook
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    protected function beforeAction(RequestInterface $request, ResponseInterface $response)
    {

    }

    /**
     * Helper for calling controller action
     *
     * @param String $actionName
     * @param RequestInterface $request
     * @param ResponseInterface $response
     *
     * @return ResponseInterface
     */
    public function callAction($actionName, RequestInterface $request, ResponseInterface $response)
    {
        // Before action hoook
        $this->beforeAction($request, $response);
        // Action call
        $response = $this->$actionName($request, $response);
        if ($this->checkResponse($response)) {
            // After action hoop
            $this->afterAction($request, $response);
        }


        return $response;
    }

    /**
     * After action hoook
     *
     * @param RequestInterface $request
     * @param ResponseInterface $response
     */
    public function afterAction(RequestInterface $request, ResponseInterface $response)
    {

    }

    /**
     * @param $response
     * @return Bool
     *
     * @throws Exception
     */
    protected function checkResponse($response)
    {
        $isResponseInterface = $response instanceof ResponseInterface;

        // Check response
        if (! $isResponseInterface) {
            throw new \Exception(
                "Controller action must return object of 'Psr\Http\Message\ResponseInterface'"
            );
        }

        return $isResponseInterface;
    }
}
