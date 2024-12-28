<?php

use Symfony\Component\Dotenv\Dotenv;

const ROOT = __DIR__;

require ROOT . '/vendor/autoload.php';
require ROOT . '/routes/index.php';

header('Access-Control-Allow-Origin: http://localhost:4321');

$envFileToLoad = "{$_SERVER['SERVER_NAME']}:{$_SERVER['SERVER_PORT']}" === 'localhost:4321'
  ? ROOT . '/.env'
  : ROOT . '/.env.production';

(new Dotenv)->load($envFileToLoad);

Flight::set('flight.views.path', $_ENV['ASTRO_BUILD_OUTDIR']);
Flight::set('flight.views.extension', '.html');
Flight::start();
