<?php

namespace ResponseTransformer;

class JsonToArrayResponseTransformer implements ResponseTransformerInterface
{

    /**
     * @var string
     */
    private $json;

    public function transformResponse()
    {
        return json_decode($this->json, true);
    }

    public function setRawResponse(string $json)
    {
        $this->json = $json;
    }
}