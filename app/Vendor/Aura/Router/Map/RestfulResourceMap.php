<?php

/**
 * Route map for Restful controllers
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

namespace App\Vendor\Aura\Router\Map;

/**
 * @see http://auraphp.com/packages/Aura.Router/custom-maps.html#2.5
 */
use Aura\Router\Map;

/**
 * @see https://github.com/doctrine/inflector
 */
use Doctrine\Common\Inflector\Inflector;

class RestfulResourceMap extends Map
{

    /**
     * @param string $namePrefix
     * @param string $pathPrefix
     *
     * @return RestfulResourceMap
     */
    public function resource(string $namePrefix, string $pathPrefix = '/api/')
    {
        return $this->attach(
            $this->formatNamePrefix($namePrefix),
            $this->formatPathPrefix($pathPrefix, $namePrefix),
            function ($map) use ($namePrefix) {
                // Set defaults params
                $this->setResourceDefaults($map, $namePrefix);
                // Set resource routers
                $this->setResourceRoutes($map);
            }
        );
    }

    /**
     * @param string $pathPrefix
     * @param string $namePrefix
     *
     * @return string
     */
    protected function formatPathPrefix(string $pathPrefix, string $namePrefix): string
    {
        return sprintf('%s%s', $pathPrefix, Inflector::pluralize($namePrefix));
    }

    /**
     * @param string $namePrefix
     *
     * @return string
     */
    protected function formatNamePrefix(string $namePrefix): string
    {
        return sprintf('%s.', $namePrefix);
    }

    /**
     * @param Map $map
     * @param string $controller
     */
    protected function setResourceDefaults(self $map, string $namePrefix)
    {
        $map->defaults([
            // Default module is api
            'module'     => 'api',
            // No default controller
            'controller' => $namePrefix,
            // Default action id "default"
            'action'     => 'default',
            // No default id
            'id'         => null,
        ]);
    }

    /**
     * @param Map $map
     */
    protected function setResourceRoutes(self $map)
    {
        /**
         * GET /
         * Find all action
         */
        $map->get('findAll', '')
          ->defaults(['action' => 'findAll']);

        /**
         * GET /<id>
         * Find one action
         */
        $map->get('findOne', '/{id}')
          ->defaults(['action' => 'findOne']);

        /**
         * PUT /<id>
         * Update one action
         */
        $map->put('update', '/{id}')
          ->defaults(['action' => 'updateOne']);

        /**
         * PATCH /<id>
         * Update one partial action
         */
        $map->patch('partialUpdate', '/{id}')
          ->defaults(['action' => 'updateOnePartial']);

        /**
         * POST /<id>
         * Create one action
         */
        $map->post('create', '')
          ->defaults(['action' => 'createNew']);

        /**
         * DELETE /<id>
         * Delete one action
         */
        $map->delete('delete', '/{id}')
          ->defaults(['action' => 'deleteOne']);
    }
}
