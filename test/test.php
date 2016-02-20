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

use wdst\IcrForms\JsonModel as JsonModel;
use wdst\IcrForms\IcrModel as IcrModel;
use wdst\IcrForms\IcrFabric as IcrFabric;

$start = microtime(true);



//$fabric = new wdst\IcrForms\IcrFabric(new wdst\IcrForms\JsonModel('http://api.json/index.php'));

//$scenario = $fabric->getScenario('participant_reg_member');
//$forms = (new Model())->getForms('participant_reg_member');

//$forms = $fabric->getForms('participant_reg_member');
//print_r($scenario);

//$fields = $fabric->getFields(168770);
//print_r($fields);

$jsonmodel = new JsonModel('http://api.json/index.php');
//$model = new IcrModel($jsonmodel, 'participant_reg_member');


$fabric = new IcrFabric($jsonmodel);


//$form = $fabric->getScenario('participant_reg_member');

//$scenario = $fabric->getScenario('participant_reg_member');

//$form = $fabric->getForm('member_personal_info');

//$form = $model->getForm(1);
$data = $jsonmodel->getStepsForm('m0iihcr227pnge6j2j7qg8k6h6', 'participant_reg_member');
print_r($data);

$groups = [];
foreach($data as $val){
    $obj = explode('.', $val['OBJ']);
    if(!empty($obj[0])){
        $val['OBJ_ID'] = $obj[1];
        $groups[$obj[0]][] = $val;
    }
}
print_r(array_keys($groups));




$end = microtime(true);
$time = $end - $start;
$time = round($time, 2);
 
print "Время выполнения скрипта $time секунд".PHP_EOL;

/*$fields = $fabric->getFields(168770);

print_r($fields['photo']->title);*/

