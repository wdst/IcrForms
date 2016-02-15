<?php

namespace wdst\IcrForms;

class IcrModel {

    public $IcrForms, $url, $formCode, $Scenario, $fabric, $method = 'post';
    public $params = [
        'lang' => 'ru'
    ];

    public function __construct(AbstractIcrModel $model, $formCode)
    {
        $this->formCode = $formCode;
        
        $this->fabric = new IcrFabric($model);
        
        $this->Scenario = $this->fabric->getScenario($formCode);

        //$this->IcrStepForms = new \wdst\IcrForms\IcrForms($model, $formCode);
    }

    public function getForm($step)
    {
        $step -= $step;
        $code = $this->Scenario->formList[$step];
        $this->IcrForms = $this->Scenario->forms[$code];
        return $this->IcrForms;
    }
    
    public function getFieldsList()
    {
        return $this->IcrForms->getFieldsList();
    }

    public function begin()
    {
        return '<form method="'.$this->method.'" action="'.$this->url.'" id="'.$this->formCode.'">';
    }

    public function end()
    {
        return '</form>';
    }

    public function buildForms($params = null)
    {
        $this->setParams($params);
        return $this->IcrForms->buildForms($this->params);
    }

    public function setParams($params)
    {
        if(!is_null($params) && is_array($params)){
            foreach ($params as $key => $value) {
                $this->params[$key] = $value;
            }
        }
    }
}