<?php

namespace tests\ApiCallFactoryTest;

use ApiCall\ApiCallInterface;
use ApiCallFactory\ApiCallFactory;
use ApiCallFactory\ApiCallFactoryInterface;
use Option\Option;
use ParameterValidator\ParameterValidator;
use PHPUnit\Framework\TestCase;

class ApiCallFactoryTest extends TestCase
{
    public function testTransformRequestParametersBoolToInt()
    {
        $validator = new ParameterValidator();
        $validator->addOption(new Option(Option::TYPE_BOOL, 'bool_false', false));
        $validator->addOption(new Option(Option::TYPE_BOOL, 'bool_true', false));

        //Add string to test return statement
        $validator->addOption(new Option(Option::TYPE_STRING, 'test_for_return', false));

        $apiCallFactory = new ApiCallFactory(
            'http://fake',
            ApiCallFactoryInterface::METHOD_GET,
            $validator,
            ['bool_false' => false, 'bool_true' => true]
        );

        $transformedParameters = $apiCallFactory->transformRequestParameters();

        $this->assertEquals(0, $transformedParameters['bool_false']);
        $this->assertEquals(1, $transformedParameters['bool_true']);

    }

    public function testTransformRequestParametersFile()
    {
        $validator = new ParameterValidator();
        $validator->addOption(new Option(Option::TYPE_FILE, 'build_file', false));

        //Add string to test return statement
        $validator->addOption(new Option(Option::TYPE_STRING, 'test_for_return', false));

        $apiCallFactory = new ApiCallFactory(
            'http://fake',
            ApiCallFactoryInterface::METHOD_GET,
            $validator,
            ['build_file' => realpath(__DIR__).'/testFile1.ipa']
        );

        $transformedParameters = $apiCallFactory->transformRequestParameters();

        $this->assertEquals($transformedParameters['build_file'], '@'.realpath(__DIR__).'/testFile1.ipa');
    }

    public function testGetApiCall()
    {
        $validator = new ParameterValidator();
        $validator->addOption(new Option(Option::TYPE_FILE, 'build_file', false));

        $apiCallFactory = new ApiCallFactory(
            'http://fake',
            ApiCallFactoryInterface::METHOD_GET,
            $validator,
            ['build_file' => realpath(__DIR__).'/testFile1.ipa']
        );

        $this->assertInstanceOf(ApiCallInterface::class, $apiCallFactory->getApiCall());
    }

}