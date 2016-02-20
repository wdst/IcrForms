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

use JsonRPC\Client as JsonRPCClient;


$Client = new JsonRPCClient('http://api.json/index.php');


$filename = '123.png';
$fb = fopen($filename, 'rb');

$blobdata = fread($fb, filesize($filename));
fclose($fb);

//$blobHandle = fbsql_create_blob($blobdata, $link);
$guid = uniqid();

try{
    $res = $Client->saveBlobs($guid, bin2hex($blobdata));
}  catch (Exception $e){
    print_r($e);
}
//print_r($res);

print $guid . PHP_EOL;