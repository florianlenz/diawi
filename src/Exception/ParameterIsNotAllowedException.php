<?php

namespace Exception;

class ParameterIsNotAllowedException extends \Exception
{
    public function __construct(string $parameterKey)
    {
        parent::__construct(sprintf('The option: "%s" is not allowed.', $parameterKey));
    }
}