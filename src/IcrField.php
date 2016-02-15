<?php

namespace wdst\IcrForms;

Class IcrField {

    public $code;
    public $obj_id;
    public $obj_type_id;
    public $attr_id_lkp;
    public $title;
    public $title_eng;
    public $is_required;
    public $placeholder;
    public $help_text;
    public $weight;
    public $type_id;
    public $attr_class;
    public $ref_to_obj_type_id;
    
    public $refList;

    public function __construct($data)
    {
        $property = [
            'code', 'obj_id', 'obj_type_id', 'attr_id', 'attr_id_lkp',
            'title', 'title_eng', 'is_required', 'placeholder', 'help_text',
            'weight', 'type_id', 'attr_class', 'ref_to_obj_type_id'
        ];

        foreach($property as $val){
            if(property_exists($this, $val)){
                $this->$val = $data[strtoupper($val)];
            }
        }
    }
}