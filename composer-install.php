<?php
ini_set('memory_limit', '-1');
require_once('composer.phar');

putenv('COMPOSER_HOME=' . __DIR__ . '/vendor/bin/composer');
putenv('COMPOSER_CACHE_DIR=' . __DIR__ . '/vendor/cache');

require_once('vendor/autoload.php');

$argv = array('command' => 'install');
$application = new Composer\Console\Application();
$application->run(new Symfony\Component\Console\Input\ArgvInput($argv));
