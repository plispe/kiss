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

use Joli\JoliNotif\Notification;

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
        // $this->logger->addInfo('Some event');
        $this->notifier->send(
             (new Notification())
                ->setTitle('Notification title')
                ->setBody('This is the body of your notification'));

        return $this->renderLatte('web/index/default');
    }
}
