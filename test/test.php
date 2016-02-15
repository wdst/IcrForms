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




/*Class ReferenceList {
    
    public $obj_id;
    public $obj_type_id;
    public $obj_caption;
    public $ot_code;
    public $rus;
    public $eng;
    
    public function __construct($data)
    {
        $property = [
            'obj_id', 'obj_type_id', 'obj_caption', 'ot_code', 'rus', 'eng'
        ];

        foreach($property as $val){
            if(property_exists($this, $val)){
                $this->$val = $data[strtoupper($val)];
            }
        }
    }
}*/

$start = microtime(true);


$fabric = new wdst\IcrForms\IcrFabric(new wdst\IcrForms\IcrModel('http://api.json/index.php'));

$scenario = $fabric->getScenario('participant_reg_member');
//$forms = (new Model())->getForms('participant_reg_member');

//$forms = $fabric->getForms('participant_reg_member');
//print_r($scenario);

//$fields = $fabric->getFields(168770);
//print_r($fields);



$end = microtime(true);
$time = $end - $start;
$time = round($time, 2);
 
print "Время выполнения скрипта $time секунд".PHP_EOL;

/*$fields = $fabric->getFields(168770);

print_r($fields['photo']->title);*/