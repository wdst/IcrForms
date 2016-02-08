<?php

namespace wdst\IcrForms;

class IcrModel {

    public $IcrForms, $url, $formCode, $method = 'post';
    public $params = [
        'lang' => 'ru'
    ];

    public function __construct(AbstractIcrModel $model, $formCode, $url)
    {
        $this->formCode = $formCode;
        $this->url = $url;
        $this->IcrForms = new \wdst\IcrForms\IcrForms(new JsonModel('http://api.json/index.php'), $formCode);
    }

    public function getFieldList()
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