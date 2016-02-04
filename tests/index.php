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

//print_r($IcrForms->fields);

//print_r($IcrForms->buildForms());

function to_utf8( $string ) {
// From http://w3.org/International/questions/qa-forms-utf-8.html
    if ( preg_match('%^(?:
      [\x09\x0A\x0D\x20-\x7E]            # ASCII
    | [\xC2-\xDF][\x80-\xBF]             # non-overlong 2-byte
    | \xE0[\xA0-\xBF][\x80-\xBF]         # excluding overlongs
    | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2}  # straight 3-byte
    | \xED[\x80-\x9F][\x80-\xBF]         # excluding surrogates
    | \xF0[\x90-\xBF][\x80-\xBF]{2}      # planes 1-3
    | [\xF1-\xF3][\x80-\xBF]{3}          # planes 4-15
    | \xF4[\x80-\x8F][\x80-\xBF]{2}      # plane 16
)*$%xs', $string) ) {
        return $string;
    } else {
        return iconv( 'CP1252', 'UTF-8', $string);
    }
} 
$a = '\xd0\xa2\xd0\xb5\xd1\x81\xd1\x82\xd0\xa4\xd0\xb0\xd0\xbc\xd0\xb8\xd0\xbb\xd0\xb8\xd1\x8f\xd1\x8f';
/*function hexToStr($hex){
 *   return hex2bin(str_replace('\x', '', $hex));
}*/

function hexToStr($hex)
{
    $string='';
    for ($i=0; $i < strlen($hex)-1; $i+=2)
    {
        $string .= chr(hex2bin($hex[$i].$hex[$i+1]));
    }
    return $string;
}
print hexToStr($a);

print PHP_EOL;