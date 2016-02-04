<?php

namespace IcrForms;

Class IcrFormBuilder implements iFormBuilder {

    protected $dataFields;
    protected $types = [
        'S' => 'input'
    ];


    public function __construct($data)
    {
        $this->dataFields = $data;
    }

    public function buildHtml($attrs_class, $attrs, $params = null)
    {
        if(!empty($this->types[$attrs_class])){
            return $this->{$this->types[$attrs_class]}($attrs, $params);
        }
        return '';
    }

    public function input($attrs, $params = null)
    {

        $name = $attrs['OT_CODE'];
        $id = $attrs['OT_CODE'];
        $default = $attrs['DEFAULT_VALUE'];

        if(!empty($params['lang']) && $params['lang'] == 'ru'){
            $title = $attrs['TITLE'];
        }
        elseif($params['lang'] == 'en'){
            $title = $attrs['TITLE_ENG'];
        }
        else {
            $title = $attrs['TITLE'];
        }

        $html = '<div class="form-group field-entryform-name required">'
                .'<label for="'.$id.'" class="control-label">'.$title.'</label>'
                .'<input type="text" name="' . $name . '" class="form-control" id="' . $id . '" value = "'.$default.'">'
                .'<div class="help-block"></div>'
                .'</div>';

        return $html;
    }
}
