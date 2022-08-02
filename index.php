<?php

require_once('libs/config.php');

use Controllers\App;

spl_autoload_register(function ($name) {
    $path = $name . '.php';

    if (file_exists($path)) {
        include_once($path);
    }
});

new App();

