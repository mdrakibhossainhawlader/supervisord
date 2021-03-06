<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\AsyncClient;
use React\EventLoop\Factory;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();
$client = AsyncClient::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $loop);

$client->clearLog()->done(function (bool $status) {
    if ($status) {
        echo 'log cleared', PHP_EOL;

        return;
    }
    echo 'unexpected false status', PHP_EOL;
}, function ($et) {
    echo (string)$et;
});

$loop->run();
