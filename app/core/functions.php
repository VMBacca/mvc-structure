<?php

function dd(...$vars): never
{
    echo '<pre style= "background-color: #f5f5f5;
    color: #212529;
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    font-family: monospace;" >';
    echo "<strong> Debug Output: </strong><br>";
    
    foreach($vars as $var){
        echo '<pre style= "background-color: #d1d1d1;
    color: #212529;
    padding: 10px;
    margin: 10px;
    border-radius: 5px;
    font-family: monospace;">';
        var_dump($var);
        echo '</pre>';
    }

    $backtrace = debug_backtrace()[0];

    echo '<br><br><strong> File: </strong> ' . $backtrace['file'] . '<br>';
    echo '<strong> Row: </strong> ' . $backtrace['line'] . '<br>';
    echo '</pre>';
    die();
}

function config(string $key, mixed $default = null):mixed
{
    $config = require_once __DIR__ . '/../config/config.php';
    return $config[$key] ?? $default;
}