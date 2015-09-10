<?php

/**
 * Adamwathan/form factory
 * @see https://github.com/adamwathan/form
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Factory\Html;

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

class Form
{
    /**
     * @param ContainerInterface $c
     *
     * @return FormBuilder
     */
    public function create(ContainerInterface $c)
    {
        return new FormBuilder;
    }
}
