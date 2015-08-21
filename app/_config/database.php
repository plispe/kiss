<?php

/**
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * Service classes and interfaces
 */
use PommProject\Foundation\Pomm;
use Spot\Locator;
use League\Monga\Database;

/**
 * Used factories
 */
use App\Factory\Database\Sql\Pomm as PommFactory;
use App\Factory\Database\Sql\Dibi;
use App\Factory\Database\Sql\Spot2;
use App\Factory\Database\NoSql\Monga;

/**
 * Interop DI intervace
 * @see https://github.com/container-interop/container-interop
 */
use Interop\Container\ContainerInterface;

return [
    /**
     * SQL database engines
     */

    /**
     * Pomm is the default one
     * @see http://www.pomm-project.org/
     */
    Pomm::class => function (ContainerInterface $c) {
        return (new PommFactory)->create($c);
    },


    /**
     * DIBI
     * @see http://dibiphp.com/
     */
    DibiConnection::class => function (ContainerInterface $c) {
        return (new Dibi)->create($c);
    },

    /**
     * Spot2
     * @see http://phpdatamapper.com/
     */
    Locator::class => function (ContainerInterface $c) {
        return (new Spot2)->create($c);
    },

    /**
     * NoSql database engines
     */

    /**
     * Monga
     * @see https://github.com/thephpleague/monga
     */
    Database::class => function (ContainerInterface $c) {
        return (new Monga)->create($c);
    }
];
