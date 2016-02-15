<?php

namespace wdst\IcrForms;
use JsonRPC\Client as JsonRPCClient;

Class JsonModel extends AbstractIcrModel{

    public $Model;

    public function __construct($url, $timeout = 3, $headers  = array()) {
        $this->Model = new JsonRPCClient($url, $timeout, $headers);
    }
    
    public function getStepFormOnly($scenarioCode)
    {
        return $this->Model->getStepFormOnly($scenarioCode);
    }
    
    public function getScenario($scenarioCode)
    {
        return $this->Model->getScenario($scenarioCode);
    }
    
    public function getForm($code)
    {
        return $this->Model->getForm($code);
    }
    
    public function getForms($scenarioCode)
    {
        return $this->Model->getForms($scenarioCode);
    }

    public function getFields($id)
    {
        return $this->Model->getFields($id);
    }

    public function getRefList($REF_TO_OBJ_TYPE_ID)
    {
        return $this->Model->getRefList($REF_TO_OBJ_TYPE_ID);
    }
}