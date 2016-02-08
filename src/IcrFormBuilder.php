<?php

namespace wdst\IcrForms;

Class IcrFormBuilder implements iFormBuilder {

    protected $dataFields;
    public $types = [
        'S' => 'input', 'PH' => 'input', 'X' => 'select'
    ];
    public $params = [
        'lang' => 'ru'
    ];

    public function __construct($data, $params = null, $types = null)
    {
        $this->dataFields = $data;

        if(!empty($params) && is_array($params)){
            $this->params = $params;
        }

        if(!empty($types) && is_array($types)){
            $this->types = $types;
        }
    }

    public function buildHtml($attrs_class, $attrs)
    {
        if(!empty($this->types[$attrs_class])){
            return $this->{$this->types[$attrs_class]}($attrs, $this->params);
        }
        return '';
    }

    public function input($attrs, $params = null)
    {
        $name = $attrs['CODE'];
        $id = $attrs['CODE'];
        $default = $attrs['DEFAULT_VALUE'];
        $help = '';$required = '';$star='';$placeholder='';

        if(!empty($params['lang']) && $params['lang'] == 'ru'){
            $title = $attrs['TITLE'];
            $help = $attrs['HELP_TEXT'];
            $placeholder = $attrs['PLACEHOLDER'];
        }
        elseif($params['lang'] == 'en'){
            $title = $attrs['TITLE_ENG'];
            $help = $attrs['HELP_TEXT_ENG'];
            $placeholder = $attrs['PLACEHOLDER_ENG'];
        }
        else {
            $title = $attrs['TITLE'];
            $help = $attrs['HELP_TEXT'];
            $placeholder = $attrs['PLACEHOLDER'];
        }

        if((int)$attrs['IS_REQUIRED']){
            $required = 'required';
            $star = '*';
        }

        $html = '<div class="form-group field-entryform-name '.$required.'">'
                .'<label for="'.$id.'" class="control-label">'.$title.$star.'</label>'
                .'<input type="text" name="' . $name . '" class="form-control" id="' . $id . '" '
                . 'value = "'.$default.'" placeholder="'.$placeholder.'">'
                .'<div class="help-block">'.$help.'</div>'
                .'</div>';

        return $html;
    }

    public function select($attrs, $params = null)
    {
        $name = $attrs['CODE'];
        $id = $attrs['CODE'];
        $default = $attrs['DEFAULT_VALUE'];
        $help = '';$required = '';$star='';$placeholder='';

        if(!empty($params['lang']) && $params['lang'] == 'ru'){
            $title = $attrs['TITLE'];
            $help = $attrs['HELP_TEXT'];
            $placeholder = $attrs['PLACEHOLDER'];
        }
        elseif($params['lang'] == 'en'){
            $title = $attrs['TITLE_ENG'];
            $help = $attrs['HELP_TEXT_ENG'];
            $placeholder = $attrs['PLACEHOLDER_ENG'];
        }
        else {
            $title = $attrs['TITLE'];
            $help = $attrs['HELP_TEXT'];
            $placeholder = $attrs['PLACEHOLDER'];
        }

        if((int)$attrs['IS_REQUIRED']){
            $required = 'required';
            $star = '*';
        }

        $select = '<select typeid='.$attrs['REF_TO_OBJ_TYPE_ID'].' class="form-control" name="'.$name.'" id="'.$id.'">';//<option value="0">1</option>
        $options = '<option></option>';
        foreach($attrs['refList'] as $val){

            if(!empty($params['lang']) && $params['lang'] == 'ru' && isset($val['RUS'])){
                $text = $val['RUS'];
            }
            elseif($params['lang'] == 'en' && isset($val['ENG'])){
                $text = $val['ENG'];
            }
            else {
                $text = $val['OBJ_CAPTION'];
            }

            $options .= '<option value="'.$val['OBJ_ID'].'">'.$text.'</option>';
        }
        $select .= $options;$select .= '</select>';

        $html = '<div class="form-group field-entryform-name '.$required.'">'
                . '<label for="'.$id.'" class="control-label">'.$title.$star.'</label>'
                . $select
                . '<div class="help-block">'.$help.'</div>'
                . '</div>';

        return $html;
    }
}
