<?php

namespace tests\ResponseTransformer;

use PHPUnit\Framework\TestCase;
use ResponseTransformer\JsonToStringResponseTransformer;

class JsonToStringResponseTransformerTest extends TestCase
{
    public function testTransform()
    {
        $responseTransformer = new JsonToStringResponseTransformer();

        $fakeResponse = json_encode(['key1' => ['key2' => 'value']]);

        $responseTransformer->setRawResponse($fakeResponse);

        $this->assertEquals($fakeResponse, $responseTransformer->transformResponse());
    }
}