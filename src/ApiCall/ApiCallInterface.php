<?php

namespace ApiCall;

use ResponseTransformer\ResponseTransformerInterface;

interface ApiCallInterface
{
    public function __construct($curlConfig);

    public function request(ResponseTransformerInterface $responseTransformer);
}