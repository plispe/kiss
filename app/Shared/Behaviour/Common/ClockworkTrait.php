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
     * @param string $id
     * @param string|null $last
     *
     * @return mixed
     */
    public function retrieveRequest(string $id, string $last = null)
    {
        return $this->clockwork->getStorage()->retrieve($id, $last);
    }

    /**
     * @param String $name
     * @param String $description
     */
    public function startEvent(string $name, string $description, $time = null)
    {
         $this->clockwork->startEvent($name, $description, $time);
    }

    /**
     * @param String $name
     */
    public function endEvent(string $name)
    {
        $this->clockwork->endEvent($name);
    }
}
