<?php

return [
    '^$' => ['controller' => 'login', 'action' => 'index'],
    '^(?P<controller>[a-z]+)/?(?P<action>[a-z]+)?/?(?P<params>[0-9]+)?$' => []
];