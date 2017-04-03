<?php

namespace tests\DiawiApi;

use DiawiApi\DiawiApi;
use PHPUnit\Framework\TestCase;
use ResponseTransformer\ResponseTransformerInterface;
use ResponseTransformer\JsonToStringResponseTransformer;

class DiawiApiTest extends TestCase
{
    public function testUpload()
    {
        $api = new DiawiApi('fake_api_key');

        $response = $api->upload(['file' => realpath(__DIR__).'/dummy.ipa']);
        $this->assertInstanceOf(ResponseTransformerInterface::class, $response);
    }

    public function testUploadCustomTransformer()
    {
        $api = new DiawiApi('fake_api_key');

        $response = $api->upload(['file' => realpath(__DIR__).'/dummy.ipa'], new JsonToStringResponseTransformer());
        $this->assertInstanceOf(JsonToStringResponseTransformer::class, $response);
    }

    public function testStatus()
    {
        $api = new DiawiApi('fake_api_key');

        $response = $api->status(['job' => 'i_am_an_id']);
        $this->assertInstanceOf(ResponseTransformerInterface::class, $response);
    }

    public function testStatusCustomTransformer()
    {
        $api = new DiawiApi('fake_api_key');

        $response = $api->status(['job' => 'i_am_an_id'], new JsonToStringResponseTransformer());
        $this->assertInstanceOf(JsonToStringResponseTransformer::class, $response);
    }

}