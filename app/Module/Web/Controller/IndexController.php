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
       if (getenv('SET_COUNTER') !== 'false') {
         $session->set('counter', 100);
       } else {
          $session->set('counter', $session->get('counter') + 1);
       }


       echo $session->get('counter');

       // dump($session->get('counter'));exit;
       // $command = new \App\Service\Command\User\Register('alice@example.com', 'secret');
       // $this->commandBus->handle($command);

        // $this->logger->addInfo('Some event');
//        $this->notifier->send(
//             (new Notification())
//                ->setTitle('Notification title')
//                ->setBody('This is the body of your notification'));
        return $response;
    }
}
