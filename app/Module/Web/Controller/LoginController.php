<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Module\Web\Controller;

/**
 * Form Builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

/**
 * PSR-7 interfaces
 * @see http://www.php-fig.org/psr/psr-7/
 */
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\RequestInterface;

class LoginController extends AbstractWebController
{
    /**
     * @Inject
     * @var FormBuilder
     */
    protected $formBuilder;

    /**
     * @param RequestInterface $request
     * @param ResponseInterface $reseponse
     *
     * @return RequestInterface
     */
    public function defaultAction(RequestInterface $request, ResponseInterface $response)
    {
        return $this->renderLatte(
            'web/login/login',
            [
                'builder' => $this->formBuilder
            ]
        );
    }
}
