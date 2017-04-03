<?php

namespace Exception;

class FileDoesNotExistException extends \Exception
{
    public function __construct($filePath)
    {
        parent::__construct(sprintf('The File: "%s" does not exist', $filePath));
    }
}