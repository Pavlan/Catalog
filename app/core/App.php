<?php


namespace app\core;


use PDOException;
use RuntimeException;

class App
{
    public static function run(): void
    {
        session_start();
        try {
            Router::routed();
        } catch (PDOException $exception) {
            echo $exception->getMessage();
        } catch (RuntimeException $exception) {
            http_response_code($exception->getCode());
            echo $exception->getMessage();
        }
    }
}