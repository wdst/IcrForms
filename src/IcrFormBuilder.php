<?php

namespace wdst\IcrForms;

Class IcrFormBuilder {
    
    public $bForm;
    
    public function __construct(IcrForm $form)
    {
        $Class = array(
            'S' => 'IcrForminput'
        );
        
        foreach ($form->fields as $key => $val){
            
            $this->bForm[] = new $Class[$val->attr_class]($val);
        }
    }
    
    
}

