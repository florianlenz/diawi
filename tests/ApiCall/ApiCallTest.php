<?php

namespace tests\ApiCallTest;

use ApiCall\ApiCall;
use Exception\CurlException;
use PHPUnit\Framework\TestCase;
use ResponseTransformer\JsonToArrayResponseTransformer;
use ResponseTransformer\ResponseTransformerInterface;

class ApiCallTest extends TestCase
{
    public function testRequestException()
    {
        $this->expectException(CurlException::class);

        $fakeUrl = 'http://alöjs43rzaöweizr4w0rfialdfqwrzfgtqzldfkhqziowrqo4hrqwer';

        $curlRes = curl_init();
        curl_setopt($curlRes, CURLOPT_URL, $fakeUrl);
        curl_setopt($curlRes, CURLOPT_RETURNTRANSFER, true);

        $apiCall = new ApiCall($curlRes);
        $apiCall->request(new JsonToArrayResponseTransformer());
    }

    public function testRequest()
    {
        $url = 'http://google.de';

        $curlRes = curl_init();
        curl_setopt($curlRes, CURLOPT_URL, $url);
        curl_setopt($curlRes, CURLOPT_RETURNTRANSFER, true);

        $apiCall = new ApiCall($curlRes);

        $respTransformer = $apiCall->request(new JsonToArrayResponseTransformer());

        $this->assertInstanceOf(ResponseTransformerInterface::class, $respTransformer);
    }

}