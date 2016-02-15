<?php

namespace wdst\IcrForms;

Class IcrFabric {

    private $Model;

    public function __construct(AbstractIcrModel $dataModel)
    {
        $this->Model = $dataModel;
    }

    public function getScenario($ScenarioCode)
    {
        $data = $this->Model->getScenario($ScenarioCode);

        $Scenario = new IcrScenario(isset($data[0]) ? $data[0] : $data);
        $Scenario->setForms($this->getForms($ScenarioCode));
        return $Scenario;
    }

    public function getForms($ScenarioCode)
    {
        $formsdata = $this->Model->getForms($ScenarioCode);
        $forms = [];
        foreach ($formsdata as $val){
            $forms[$val['CODE']] = $this->getForm($val);
            $forms[$val['CODE']]->fields = $this->getFields($val['OBJ_ID']);
        }
        return $forms;
    }

    private function getForm($data)
    {
        return new IcrForm($data);
    }

    public function getFields($OBJ_ID)
    {
        $fieldsdata = $this->Model->getFields($OBJ_ID);
        $fields = [];
        foreach ($fieldsdata as $val){
            $fields[$val['CODE']] = $this->getField($val);

            if($val['ATTR_CLASS'] == 'X'){
                $fields[$val['CODE']]->refList = $this->getRefList($val['REF_TO_OBJ_TYPE_ID']);
            }
        }
        return $fields;
    }

    private function getField($data)
    {
        return new IcrField($data);
    }

    public function getRefList($REF_TO_OBJ_TYPE_ID)
    {
        return $this->Model->getRefList($REF_TO_OBJ_TYPE_ID);
    }
}