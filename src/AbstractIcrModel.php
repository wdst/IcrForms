<?php

namespace wdst\IcrForms;

/**
 * Description of AbstractModel
 *
 * @author wds
 */
abstract class AbstractIcrModel {

    public $client;
    
    abstract public function save();

    public function getForm($code)
    {
        return $this->client->getForm($code);
    }

    public function getFormFields($form_id)
    {
        return $this->client->getFormFields($form_id);
    }

    public function getDataFields()
    {
        return $this->client->getDataFields();
    }

    public function object($obj)
    {
        return $this->client->object(json_encode($obj));
    }
}