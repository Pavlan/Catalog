<?php


namespace app\core;


class View
{
    public $data = [];

    public function display(string $template, $data = []): void
    {
        $this->data = $data;
        require dirname(__DIR__) . '/views/templates/' . $template;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __isset($name)
    {
        return isset($this->data[$name]);
    }
}