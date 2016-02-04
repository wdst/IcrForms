<?php

namespace IcrForms;

Class IcrFormBuilder implements iFormBuilder {

    protected $dataFields;
    protected $types = [
        's' => 'input'
    ];


    public function __construct($data) 
    {
        $this->dataFields = $data;
    }
    
    public function buildHtml($attrs_class, $attrs, $params = null)
    {       
        return @call_user_method($this->types[$attrs_class], $attrs, $params);
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
        
        $title = !empty($params['lang']) && $params['lang'] == 'ru' ?
        
        $html = '<div class="form-group field-entryform-name required has-error">'
                .'<label for="'.$id.'" class="control-label">'.$title.'</label>'
                .'<input type="text" name="' . $name . '" class="form-control" id="' . $id . '" value = "'.$default.'">'
                .'<div class="help-block"></div>'
                .'</div>';
        
        return $html;
    } 
}
