<?php

namespace wdst\IcrForms;

Class IcrForms {

    public $Model, $objType, $formCode, $dataFields;

    private $attrs = ['OBJ_ID', 'OBJ_TYPE_ID', 'OBJ_CAPTION', 'OT_CODE',
        'FORM_NUMBER', 'FORM_NAME_RUS', 'FORM_NAME_ENG'];

    public $fields;
    public $params = null;
    public $types = null;public $test = null;

    public function __construct(AbstractIcrModel $IcrModel, $formCode)
    {
        $this->Model = $IcrModel;
        $this->code = $formCode;

        $this->reload();
    }

    public function reload()
    {
        $this->loadForm();
        $this->loadDataFields();
        $this->loadFields();
    }

    public function loadForm()
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

    public function loadFields()
    {
        $data = $this->Model->getFormFields($this->OBJ_ID);

        $builder = new IcrFormBuilder(new IcrDataFields($this->dataFields));

        foreach($data as $val){

            $field = new IcrFormField($val['CODE'], $val, $builder);

            if($val['ATTR_CLASS'] == 'X'){
                $field->refList = $this->loadRefFieldList($val['REF_TO_OBJ_TYPE_ID']);
            }
            
            $this->fields[$val['CODE']] = $field;
        }
    }

    public function loadDataFields()
    {
        $this->dataFields = $this->Model->getDataFields();
    }
    
    function loadRefFieldList($typeid)
    {
        return $this->Model->client->getRefList($typeid);
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

    public function buildForms($params = null, $types = null)
    {
        $html = '';
        
        foreach($this->fields as $val){
            $html .= $val->build($params, $types);
        }

        return $html;
    }
}
