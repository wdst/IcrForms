<?php

namespace wdst\IcrForms;

class IcrModel {

    public $IcrForms, $url, $formCode, $Scenario, $fabric, $method = 'post', $model;
    public $params = [
        'lang' => 'ru'
    ];

    public function __construct(AbstractIcrModel $model, $formCode)
    {
        $this->formCode = $formCode;
        
        $this->fabric = new IcrFabric($model);
        
        $this->model = $model;
        
        $this->Scenario = $this->fabric->getScenario($formCode);

        //$this->IcrStepForms = new \wdst\IcrForms\IcrForms($model, $formCode);
    }

    public function getForm($step)
    {
        $step = $step - 1;
        $code = !empty($this->Scenario->formList[$step]) ?
                    $this->Scenario->formList[$step] : null;
        
        if($code === null){
            return null;
        }
        
        return $this->fabric->getForm($code);
        //$this->IcrForms = $this->Scenario->forms[$code];
        //return $this->IcrForms;
    }
    
    public function getScenario($step)
    {
        return $this->Scenario->formList[$step];
    }

    public function getCountStep()
    {
        return count($this->Scenario->formList);
    }

    public function intermediate_save($guid, $code, $step, $key, $val)
    {
        return $this->model->setSaveStepForm($guid, $code, $step, $key, $val);
    }

    public function getValue($guid, $code, $step)
    {
        $data = $this->model->getValue($guid, $code, $step);

        $res = array();
        foreach($data as $val){
            $res[$val['PARAMS']] = $val['FVALUE'];
        }

        return $res;
    }
}