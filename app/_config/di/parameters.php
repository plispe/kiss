<?php

/**
 * defines useful DI parameters
 *
 * @author Petr Pliska <petr.pliska@post.cz>
 */

return [
    'app.dir' => __DIR__ . '/../../',
    'log.dir' => DI\string('{app.dir}../log/'),
    'temp.dir' => DI\string('{app.dir}../temp/'),
    'files.dir' => DI\string('{app.dir}../files/'),
    'config.dir' => DI\string('{app.dir}_config/'),
    'templates.dir' => DI\string('{app.dir}_templates/')
];
