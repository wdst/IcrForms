<?php

namespace wdst\IcrForms;

use JsonRPC\Client as JsonRPCClient;

abstract class AbstractIcrModel{

    public $Model;

    abstract public function getScenario($scenarioCode);

    abstract public function getForms($scenarioCode);

    abstract public function getFields($id);

    abstract public function getRefList($REF_TO_OBJ_TYPE_ID);
}