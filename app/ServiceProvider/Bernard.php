<?php

namespace App\ServiceProvider;

use App\Vendor\Bernard\Router\PhpDiAwareRouter;
use Bernard\Consumer;
use Bernard\EventListener;
use Bernard\Message;
use Bernard\Producer;
use Bernard\QueueFactory\PersistentFactory;
use Bernard\Router\SimpleRouter;
use Bernard\Serializer;
use Interop\Container\ContainerInterface;
use Symfony\Component\EventDispatcher\EventDispatcher;

use Pheanstalk\Pheanstalk;
use Bernard\Driver\PheanstalkDriver;

use Interop\Container\ServiceProvider;

use Bernard\Serializer\JMSSerializer;
use Bernard\JMSSerializer\EnvelopeHandler;
use JMS\Serializer\SerializerBuilder;

/**
 * Class Bernard
 * @package App\ServiceProvider
 * @author Petr Pliska <petr.pliska@post.cz>
 */
class Bernard implements ServiceProvider
{

    /**
     * Returns a list of all container entries registered by this service provider.
     *
     * - the key is the entry name
     * - the value is a callable that will return the entry, aka the **factory**
     *
     * Factories have the following signature:
     *        function(ContainerInterface $container, callable $getPrevious = null)
     *
     * About factories parameters:
     *
     * - the container (instance of `Interop\Container\ContainerInterface`)
     * - a callable that returns the previous entry if overriding a previous entry, or `null` if not
     *
     * @return callable[]
     */
    public function getServices()
    {
        return [
            Producer::class => $this->getProducer(),
            Consumer::class => $this->getConsumer(),
        ];
    }

    /**
     * @return Serializer
     */
    protected function getSerializer()
    {
        return new Serializer;
    }

    /**
     * @return EventDispatcher
     */
    protected function getEventDispatcher()
    {
        $dispatcher = new EventDispatcher;
        $dispatcher->addSubscriber(new EventListener\ErrorLogSubscriber);
        $dispatcher->addSubscriber(new EventListener\FailureSubscriber($this->getQueueFactory()));
        return $dispatcher;
    }

    /**
     * @return PersistentFactory
     */
    protected function getQueueFactory()
    {
        return new PersistentFactory($this->getDriver(), $this->getSerializer());
    }

    /**
     * @return Producer
     */
    protected function getProducer()
    {
        return function () {
            return new Producer($this->getQueueFactory(), $this->getEventDispatcher());
        };
    }

    /**
     * @return SimpleRouter
     */
    protected function getReceivers(ContainerInterface $container)
    {
        return new PhpDiAwareRouter($container);
    }

    /**
     * @return Consumer
     */
    protected function getConsumer()
    {
        return function (ContainerInterface $container) {
            return new Consumer($this->getReceivers($container), $this->getEventDispatcher());
        };
    }

    /**
     * @return PheanstalkDriver
     */
    protected function getDriver()
    {
        $pheanstalk = new Pheanstalk('localhost');
        return new PheanstalkDriver($pheanstalk);
    }
}
