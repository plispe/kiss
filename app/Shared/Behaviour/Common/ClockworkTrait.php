<?php

/**
 * Clockwork helper
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */
namespace App\Shared\Behaviour\Common;

trait ClockworkTrait
{
    /**
     * @Inject
     * @var \Clockwork\Clockwork
     */
    protected $clockwork;

    /**
     * Log request infor
     */
    public function logRequest()
    {
         $this->clockwork
            ->resolveRequest()
            ->storeRequest();
    }

    /**
     * @param Int $id
     * @param Int $last
     */
    public function retrieveRequest($id, $last = null)
    {
        return $this->clockwork->getStorage()->retrieve($id, $last);
    }

    /**
     * @param String $name
     * @param String $description
     */
    public function startEvent($name, $description, $time = null)
    {
         $this->clockwork->startEvent($name, $description, $time);
    }

    /**
     * @param String $name
     */
    public function endEvent($name)
    {
        $this->clockwork->endEvent($name);
    }
}
