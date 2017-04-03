<?php

namespace Exception;

class GotWrongVariableTypeException extends \Exception
{
    public function __construct(string $type,string $parameterKey)
    {
        parent::__construct(sprintf('Expect type of "%s" for key: "%s"', $type, $parameterKey));
    }
}