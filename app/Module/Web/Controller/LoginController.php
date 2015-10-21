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

class LoginController extends AbstractWebController
{
    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function defaultAction(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        return $this->renderLatte(
            'web/login/login',
            [
                'builder' => $this->formBuilder
            ]
        );
    }
}
