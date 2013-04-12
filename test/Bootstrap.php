<?php

/**
 * Setup autoloading
 */
$loader = require_once __DIR__ . '/../../../autoload.php';

/*
 * Load the user-defined test configuration file, if it exists; otherwise, load
 * the default configuration.
 */
if (is_readable(__DIR__ . DIRECTORY_SEPARATOR . 'TestConfig.php')) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestConfig.php';
} else {
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'TestConfig.php.dist';
}
