<?php

namespace Exception;

class MissingRequiredParameterException extends \Exception
{
    public function __construct(string $key)
    {
        parent::__construct(sprintf('The required parameter: "%s" is missing.', $key));
    }
}