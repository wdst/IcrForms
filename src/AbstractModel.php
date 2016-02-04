<?php

namespace IcrForms;
use JsonRPC\Client as JsonRPCClient;
/**
 * Description of AbstractModel
 *
 * @author ssi
 */
abstract class AbstractModel {

    public $client;

    public function __construct($url) {
        $this->client = new JsonRPCClient($url);
    }

    /*abstract public function getTypes($param);
    abstract public function getObject($param);*/
    abstract public function save();


}
