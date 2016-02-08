<?php

namespace wdst\IcrForms;
use JsonRPC\Client as JsonRPCClient;

Class JsonModel extends AbstractIcrModel{

    public function __construct($url, $timeout = 3, $headers  = array()) {
        $this->client = new JsonRPCClient($url, $timeout, $headers);
    }
    
    function save(){

    }
}