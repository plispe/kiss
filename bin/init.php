#!/usr/bin/env php
<?php

/**
 * Init script - Created .env file with default variables
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

// .env file (only for development)
$envFile = __DIR__ . '/../.env';
// Default ENV variables
$envVariables = [
    'USE_PHPDI_CACHE' => 'false',
    'USE_LATTE_CACHE' => 'true',
    'DISPLAY_ERRORS'  => 'false',
];

// If file does not exists
if (! file_exists($envFile)) {
    $dotenvFileContent = '';
    // Create .env file content
    foreach ($envVariables as $name => $value) {
        $dotenvFileContent .= sprintf("%s=\"%s\"\n", $name, $value);
    }
    // Write file with defaults variables
    file_put_contents($envFile, $dotenvFileContent);
}
