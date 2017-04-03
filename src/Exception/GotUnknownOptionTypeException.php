<?php

namespace Exception;

class GotUnknownOptionTypeException extends \Exception
{
    public function __construct($type)
    {
        parent::__construct(sprintf('Got unexpected type: "%s"', $type));
    }
}