<?php

spl_autoload_register(function ($class) {
    require dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
});