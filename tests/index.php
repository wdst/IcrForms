<?php

require __DIR__ . '/../vendor/autoload.php';
spl_autoload_register(function ($class) {
    $prefix = 'wdst\\IcrForms\\';
    $base_dir = __DIR__ . '/../src/';
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});


$IcrForms = new wdst\IcrForms\IcrForms(new wdst\IcrForms\Model('http://api.json/index.php'), 'reg_eburg');


//print_r($IcrForms->getFieldsList());
//print_r($IcrForms->fields);

print_r($IcrForms->dataFields);

