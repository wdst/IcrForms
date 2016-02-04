<?php

namespace wdst\IcrForms;

class IcrFormField {

    public $code;
    protected $attrs, $val, $builder;
    public $html;

    public function __construct($code, $val, iFormBuilder $builder) {
        $this->code = $code;

        $this->loadAttrs($val);

        $this->val = $val;
        $this->builder = $builder;
    }

    public function __get($name)
    {
        return $this->attrs[$name];
    }

    public function __set($name, $value)
    {
        $this->attrs[$name] = $value;
        return true;
    }

    public function loadAttrs($attrs)
    {
        foreach($attrs as $key=>$val){
            $this->attrs[$key] = $val;
        }
    }

    public function build($params = null, $types = null)
    {
        if(!empty($params) && is_array($params)){
            $this->builder->params = $params;
        }

        if(!empty($types) && is_array($types)){
            $this->builder->types = $types;
        }

        $this->html = $this->builder->buildHtml($this->attrs['ATTR_CLASS'], $this->val);
        return $this->html;
    }
}