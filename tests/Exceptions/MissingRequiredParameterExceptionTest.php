<?php

namespace tests\Exceptions;

use Exception\MissingRequiredParameterException;
use PHPUnit\Framework\TestCase;

class MissingRequiredParameterExceptionTest extends TestCase
{
    public function testExceptionMessage()
    {
        $exception = new MissingRequiredParameterException("foo");

        $this->assertEquals('The required parameter: "foo" is missing.', $exception->getMessage());
    }
}