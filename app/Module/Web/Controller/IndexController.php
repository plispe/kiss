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

use PSR7Session\Http\SessionMiddleware;

class IndexController extends AbstractWebController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function defaultAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
       $session = $request->getAttribute(SessionMiddleware::SESSION_ATTRIBUTE);
       // $session->set('counter',0);

       dump($session->get('counter',0));exit;
       // $command = new \App\Service\Command\User\Register('alice@example.com', 'secret');
       // $this->commandBus->handle($command);

        // $this->logger->addInfo('Some event');
//        $this->notifier->send(
//             (new Notification())
//                ->setTitle('Notification title')
//                ->setBody('This is the body of your notification'));
//
        $response
               ->getBody()
               ->write('Counter Value: ' . $session->get('counter'));
        return $response;
    }
}
