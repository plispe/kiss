<?php

/**
 * Factory functions loader
 *
 * @author Petr Pliska
 */
foreach (glob(__DIR__ . '/Factory/*.php') as $file) {
    require_once $file;
}
