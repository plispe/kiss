<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    /**
     * Run PHP build-in server
     */
    public function devtoolsRunPhpServer()
    {
        $this->taskServer(8080)
            ->host('localhost')
            ->dir('public')
            ->printed(true)
            ->run();
    }

    /**
     * Check syntax of php code
     */
    public function devtoolsCheckPhpSyntax()
    {
        $this
            ->taskExec('vendor/bin/parallel-lint')
            ->option('exclude', 'vendor')
            ->arg('.')
            ->run();
    }

    /**
     * Check PSR-2 coding style
     */
    public function devtoolsCheckPhpCodingStyle()
    {
        $this
            ->taskExec('vendor/bin/phpcs')
            ->option('colors')
            ->option('standard=PSR2')
            ->option('encoding=utf-8')
            ->option('report=full')
            ->option('warning-severity=0')
            ->arg('app')
            ->run();

    }

    /**
     * Calculate PHP metrics
     */
    public function devtoolsCalculatePhpMetrics()
    {
        $this
            ->taskExec('vendor/bin/phpmetrics')
            ->option('config','phpmetrics.yml')
            ->option('failure-condition', 'false <> false')
            ->arg('.')
            ->printed(true)
            ->run();
    }
}
