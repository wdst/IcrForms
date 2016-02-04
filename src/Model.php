<?php

namespace IcrForms;
use JsonRPC\Client as JsonRPCClient;

Class Model extends AbstractModel{

    function save(){

    }

    public function getForm($code)
    {
        //$client = new JsonRPCClient('http://api.json/index.php');
        //$this->client->debug = 1;
        return $this->client->getForm($code);
    }


    public function getFormFields($form_id)
    {
        //$client = new JsonRPCClient('http://api.json/index.php');
        //$this->client->debug = 1;
        return $this->client->getFormFields($form_id);
    }
    
    public function getDataFields()
    {
        //$client = new JsonRPCClient('http://api.json/index.php');
        //$this->client->debug = 1;
        return $this->client->getFormFields($form_id);
    }   
}