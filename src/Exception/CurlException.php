<?php

namespace Exception;

class CurlException extends \Exception
{
    public function __construct(string $curlError)
    {
        parent::__construct(sprintf('Curl error: "%s"', $curlError));
    }
}