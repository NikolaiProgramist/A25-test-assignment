<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Nikolai\A25TestAssignment\Controllers\TaskController;
use Uri\Rfc3986\Uri;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$uri = new Uri($_SERVER['REQUEST_URI']);

echo match ($uri->getPath()) {
    '/api/tasks' => new TaskController()->tasks(),
    '/tasks' => require_once 'resources/views/tasks.html',
    default => require_once 'resources/views/404.html'
};
