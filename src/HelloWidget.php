<?php

namespace wdst\IcrForms;

use yii\base\Widget;
use yii\helpers\Html;

class HelloWidget extends \yii\base\Widget
{
    public $message;
    
    public function init()
    {
        parent::init();
        if($this->message === null){
            $this->message = 'Hello Yii';
        }
    }
    
    public function run($a = null)
    {
        return Html::encode($this->message . $a);
    }
}

