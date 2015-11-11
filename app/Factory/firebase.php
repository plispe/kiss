<?php

namespace App\Factory;

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

/**
 * @see https://github.com/ktamas77/firebase-php
 */
use Firebase\FirebaseLib;

if (! function_exists('App\Factory\firebase')) {
    /**
     * @param ContainerInterface $c
     * @return FirebaseLib
     */
    function firebase(ContainerInterface $c): FirebaseLib
    {
        return new FirebaseLib(getenv('FIREBASE_URL'), getenv('FIREBASE_TOKEN'));
    }
}