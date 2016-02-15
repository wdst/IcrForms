<?php

namespace wdst\IcrForms;

Class IcrForm {
    
    public $code;
    public $obj_id;
    public $obj_type_id;
    public $obj_caption;
    public $ot_code;
    public $form_number;
    public $form_name_rus;
    public $form_name_eng;
    public $fields;

    public function __construct($data)
    {
        $property = [
            'code', 'obj_id', 'obj_type_id', 'obj_caption', 'ot_code',
            'form_number', 'form_name_rus', 'form_name_eng'
        ];

        foreach($property as $val){
            if(property_exists($this, $val)){
                $this->$val = $data[strtoupper($val)];
            }
        }
    }
}