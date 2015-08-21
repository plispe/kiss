<?php

/**
 * defines useful DI parameters
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

return [
    'app.dir'         => __DIR__ . '/../',
    'log.dir'         => DI\string('{app.dir}../log/'),
    'temp.dir'        => DI\string('{app.dir}../temp/'),
    'files.dir'       => DI\string('{app.dir}../files'),
    'templates.dir'   => DI\string('{app.dir}_templates/'),
    'stash.cache.dir' => DI\string('{temp.dir}cache/stash/'),
    'latte.cache.dir' => DI\string('{temp.dir}cache/latte/'),
    'clockwork.dir' => DI\string('{temp.dir}clockwork/'),
    'db.dsn'          => DI\env('DATABASE_DSN'),
];
