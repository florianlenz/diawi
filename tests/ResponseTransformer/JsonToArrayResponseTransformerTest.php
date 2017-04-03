<?php

declare(strict_types=1);

namespace tests\ResponseTransformer;

use PHPUnit\Framework\TestCase;
use ResponseTransformer\JsonToArrayResponseTransformer;

class JsonToArrayResponseTransformerTest extends TestCase
{
    public function testTransform()
    {
        //Create transformer
        $transformer = new JsonToArrayResponseTransformer();

        //Test array
        $associativeArray = [
            'key1' => [
                'key1.key1' => 'I am an example'
            ],
            'key2' => 'I am an string'
        ];

        $transformer->setRawResponse(json_encode($associativeArray));

        $this->assertEquals($associativeArray, $transformer->transformResponse());
    }
}