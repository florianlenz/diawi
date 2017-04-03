<?php

namespace ApiCall;

use Exception\CurlException;
use ResponseTransformer\ResponseTransformerInterface;

class ApiCall implements ApiCallInterface
{

    /**
     * @var resource
     */
    private $curlConfig;

    /**
     * ApiCall constructor.
     * @param $curlConfig
     */
    public function __construct($curlConfig)
    {
        $this->curlConfig = $curlConfig;
    }

    public function request(ResponseTransformerInterface $responseTransformer) : ResponseTransformerInterface
    {
        //Raw curl response
        $rawResponse = curl_exec($this->curlConfig);

        //Throw exception
        if(curl_error($this->curlConfig)){
            throw new CurlException(curl_error($this->curlConfig));
        }

        curl_close($this->curlConfig);

        $responseTransformer->setRawResponse($rawResponse);

        return $responseTransformer;
    }

}