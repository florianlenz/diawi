<?php

namespace ResponseTransformer;

interface ResponseTransformerInterface
{
    public function transformResponse();

    public function setRawResponse(string $json);
}