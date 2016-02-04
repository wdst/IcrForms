<?php

namespace IcrForms;

Class IcrForms {

    public $Model, $objType, $formCode, $dataFields;

    private $attrs = ['OBJ_ID', 'OBJ_TYPE_ID', 'OBJ_CAPTION', 'OT_CODE',
        'FORM_NUMBER', 'FORM_NAME_RUS', 'FORM_NAME_ENG'];

    public $fields;

    public function __construct(AbstractModel $IcrModel, $formCode)
    {
        $this->Model = $IcrModel;
        $this->code = $formCode;

        $this->loadForm();
        $this->loadDataFields();
        $this->loadFields();
    }

    function loadForm()
    {
        $data = $this->Model->getForm($this->code);

        if(empty($data[0])){
            throw new Exception('Forms ', $code, ' does not exists');
        }

        foreach($data[0] as $key=>$val){
            if(in_array($key, $this->attrs)){
                $this->$key = $val;
            }
        };
    }

    function loadFields()
    {
        $data = $this->Model->getFormFields($this->OBJ_ID);

        $builder = new IcrFormBuilder(new IcrDataFields($this->dataFields));

        foreach($data as $val){

            $field = new IcrFormFields($val['CODE'], $val, $builder);

            //$field->loadAttrs($val);

            $this->fields[$val['CODE']] = $field;
        }
    }

    function loadDataFields()
    {
        $this->dataFields = $this->Model->getDataFields();
    }

    function getFieldsList()
    {
        return array_keys($this->fields);
    }

    public function __get($name)
    {
        $name = strtoupper($name);
        return $this->$name;
    }
}
