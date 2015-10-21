<?php

/**
 * Adamwathan/form factory
 * @see https://github.com/adamwathan/form
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory;

/**
 * Form builder
 * @see https://github.com/adamwathan/form
 */
use AdamWathan\Form\FormBuilder;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

if (! function_exists('App\Factory\formbuilder'))
{
    /**
     * @param ContainerInterface $c
     *
     * @return FormBuilder
     */
    function formbuilder(ContainerInterface $c): FormBuilder
    {
        return new FormBuilder;
    }
}
