<?php

/**
 * Parses .env file if file is present
 *
 * All config should be stored in environment
 * @see http://12factor.net/config
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

/**
 * @var String path to .env file
 */
$dotEnvFile = __DIR__ . '/../';

/*
 * if .env file exists it will be parsed
 */
if (getenv('USE_DOTENV_FILE') !== 'false' && file_exists($dotEnvFile)) {
    /**
     * .env file parser
     * 
     * @see https://github.com/vlucas/phpdotenv
     */
    (new Dotenv\Dotenv($dotEnvFile))->load();
}
