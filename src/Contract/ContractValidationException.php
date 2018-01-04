<?php

namespace Peec\Bring\API\Contract;

class ContractValidationException extends \Exception
{

    protected $_fields = [];

    public function addField ($field) {
        $this->_fields[] = $field;
    }

    public function getFields() {
        return $this->_fields;
    }

}