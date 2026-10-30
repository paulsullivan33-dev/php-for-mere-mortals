<?php
// use-monolog.php — proof that the installed library is real:
// load it through Composer's autoloader and write a log line.
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger('noticeboard');
$log->pushHandler(new StreamHandler(__DIR__ . '/noticeboard.log', Logger::INFO));

$log->info('Notice pinned', ['name' => 'Priya', 'notice' => 'Yoga moves to Thursdays']);
echo "Logged. The Logger class came from: ",
    (new ReflectionClass(Logger::class))->getFileName(), "\n";
