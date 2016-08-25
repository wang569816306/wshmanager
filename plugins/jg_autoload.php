<?php
function classLoader($class)
{
    $path = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $file = __DIR__ . '/jg_src/' . $path . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
    echo $file;
}
spl_autoload_register('classLoader');



?>