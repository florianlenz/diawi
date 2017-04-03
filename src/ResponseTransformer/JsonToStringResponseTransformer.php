<?php

namespace ResponseTransformer;

class JsonToStringResponseTransformer implements ResponseTransformerInterface
{

    /**
     * @var string
     */
    private $response;

    public function transformResponse()
    {
        return $this->response;
    }

    public function setRawResponse(string $json)
    {
        $this->response = $json;
    }
}