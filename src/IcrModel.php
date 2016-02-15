<?php

namespace wdst\IcrForms;

use JsonRPC\Client as JsonRPCClient;

Class IcrModel extends AbstractIcrModel{

    public $Model;

    public function __construct($url)
    {
        $this->Model = new JsonRPCClient($url);
    }

    public function getScenario($scenarioCode)
    {
        return $this->Model->getStepFormOnly($scenarioCode);
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