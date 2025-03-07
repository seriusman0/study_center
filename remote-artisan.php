<?php
define('LARAVEL_START', microtime(true));

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);

// Contoh penggunaan
if (isset($_GET['command'])) {
    $command = $_GET['command'];
    $kernel->call($command);
}