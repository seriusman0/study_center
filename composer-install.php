<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 900); // 15 minutes

if (file_exists('composer.phar')) {
    require_once('composer.phar');
} else {
    die('composer.phar not found');
}

putenv('COMPOSER_HOME=' . __DIR__ . '/vendor/bin/composer');
putenv('COMPOSER_CACHE_DIR=' . __DIR__ . '/vendor/cache');

$argv = array('command' => 'install');
$application = new Composer\Console\Application();
$application->run(new Symfony\Component\Console\Input\ArgvInput($argv));
