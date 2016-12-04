<?php


namespace Lorenzschaef\PHPDDDMD;


class InvalidRulePropertyException extends \RuntimeException
{

    public function __construct($rule, $propertyName, $value)
    {
        parent::__construct('Invalid value for property ' . $propertyName . ' of rule ' . $rule . ': ' . $value);
    }

}