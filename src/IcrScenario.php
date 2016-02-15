<?php

namespace wdst\IcrForms;

Class IcrScenario {

    public $obj_id;
    public $obj_type_id;
    public $obj_caption;
    public $ot_code;
    public $name_eng;
    public $name;
    public $code;
    public $form_desc;
    public $lk;
    public $lk_lkp;

    public $forms;
    public $formList;
    public $step;

    public function __construct($data)
    {
        $property = [
            'obj_id', 'obj_type_id', 'obj_caption', 'ot_code', 'name_eng', 
            'name', 'code', 'form_desc', 'lk', 'lk_lkp'
        ];

        foreach($property as $val){
            if(property_exists($this, $val)){
                $this->$val = $data[strtoupper($val)];
            }
        }
    }

    public function setForms($data)
    {
        $this->forms = $data;
        $this->formList = array_keys($data);
    }
}

