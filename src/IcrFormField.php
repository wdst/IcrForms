<?php

namespace IcrForms;

class IcrFormField {

    public $code;
    protected $attrs;
    public $html;

    public function __construct($code, $val, iFormBuilder $builder) {
        $this->code = $code;

        $this->loadAttrs($val);


        //print_r($this->attrs['ATTR_CLASS']);
        $this->html = $builder->buildHtml($this->attrs['ATTR_CLASS'], $val);
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

    /*public function builder(AbstractDataFields $dataBuilder)
    {
        $builder = new IcrFormBuilder()
    }*/
}