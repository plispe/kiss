<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function appServe()
    {
        $this->taskServer(8080)
            ->host('localhost')
            ->dir('public')
            ->printed(true)
            ->run();
    }

    public function docsGenerateApi()
    {
        dump($this->taskApiGen()
            ->templateConfig('vendor/apigen/apigen/templates/bootstrap/config.neon')
            ->wipeout(true));

    }
}
