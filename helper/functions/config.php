<?php
namespace app\helper\functions;
use app\config\Loader;


function config($data, $def = 'app') {
    $loader = new Loader();
    return $loader->config($data, $def);
}