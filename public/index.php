<?php
/*********************************************************************
    /public/index.php

    CS Plus Front Controller

    Anthony Hudson <anthonyhud843@outlook.com>
    Copyright (c)  2025 csPlus

    Released under the GNU General Public License WITHOUT ANY WARRANTY.

**********************************************************************/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../bootstrap.php');

use App\Core\Router;

$router = new Router();
require_once __DIR__ . '/../config/routes.php';

$router->dispatch($_SERVER['REQUEST_URI']);