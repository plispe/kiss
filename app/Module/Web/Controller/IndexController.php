<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Module\Web\Controller;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\{RequestInterface, ResponseInterface};

class IndexController extends AbstractWebController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $response
     * @return ResponseInterface
     */
    public function defaultAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
       // $command = new \App\Service\Command\User\Register('alice@example.com', 'secret');
       // $this->commandBus->handle($command);
        return $this->view->render('web/index/default.latte');
    }
}
