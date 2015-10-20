<?php

/**
 * Defines method for handlin failure
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Shared\Behaviour\Middleware;

use Aura\Router\Matcher;

/**
 * Symfony http exceptions
 */
use Symfony\Component\HttpKernel\Exception\{
    NotFoundHttpException, NotAcceptableHttpException, MethodNotAllowedHttpException
};

trait AuraFailureHandlingTrait
{
    /**
     * @param Aura\Router\Matcher $matcher
     *
     * @throws NotAcceptableHttpException
     * @throws MethodNotAllowedHttpException
     * @throws NotFoundHttpException
     */
    protected function handleFailure(Matcher $matcher)
    {
        // get the first of the best-available non-matched routes
        $failedRoute = $matcher->getFailedRoute();

        // which matching rule failed?
        switch (isset($failedRoute->failedRule) ? $failedRoute->failedRule : false) {
            case 'Aura\Router\Rule\Allows':
                throw new MethodNotAllowedHttpException($failedRoute->allows);
            case 'Aura\Router\Rule\Accepts':
                throw new NotAcceptableHttpException;
            default:
                throw new NotFoundHttpException;
        }
    }
}
