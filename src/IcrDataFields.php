<?php

namespace IcrForms;

Class IcrDataFields extends AbstractDataFields {
    
    public function __construct($dataArray) 
    {
        foreach ($dataArray[0] as $key => $value)
        {
            if(property_exists($this, $key)){
                $this->$key = $value;
            }
        }
    }
}
