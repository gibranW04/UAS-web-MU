<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(getcwd());
$vars = $dotenv->load();
echo 'DB_HOST: [' . ($_ENV['DB_HOST'] ?? 'NOT SET') . ']' . PHP_EOL;
echo 'DB_PORT: [' . ($_ENV['DB_PORT'] ?? 'NOT SET') . ']' . PHP_EOL;
echo 'DB_DATABASE: [' . ($_ENV['DB_DATABASE'] ?? 'NOT SET') . ']' . PHP_EOL;
echo 'DB_USERNAME: [' . ($_ENV['DB_USERNAME'] ?? 'NOT SET') . ']' . PHP_EOL;
echo 'DB_PASSWORD: [' . ($_ENV['DB_PASSWORD'] ?? 'NOT SET') . ']' . PHP_EOL;
echo PHP_EOL;
echo 'Checking loaded keys:' . PHP_EOL;
foreach ($_ENV as $k => $v) {
    if (strpos($k, 'DB_') === 0) {
        echo "  $k = [$v]" . PHP_EOL;
    }
}
