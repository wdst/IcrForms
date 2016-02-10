<?php

namespace wdst\IcrForms;

Class IcrStepForms {
    public $Model, $objType, $dataFields, $forms;

    public function __construct(AbstractIcrModel $IcrModel, $Code)
    {
        $this->Model = $IcrModel;
        $this->code = $Code;
    }

    public function getForm($step)
    {
        if(empty($step)){
            throw new \Exception('bad step');
        }
        
        $step -= 1;
        
        $this->forms = $this->Model->getStepForm($this->code);

        if(!empty($this->forms) && isset($this->forms[$step])){
            return $this->forms[$step];
        }
        return array();
    }
}
