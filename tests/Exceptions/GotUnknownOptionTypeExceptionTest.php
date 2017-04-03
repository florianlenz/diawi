<?php

namespace tests\Exceptions;

use Exception\GotUnknownOptionTypeException;
use PHPUnit\Framework\TestCase;

class GotUnknownOptionTypeExceptionTest extends TestCase
{
    public function testException()
    {
        $exception = new GotUnknownOptionTypeException('int_128');

        $this->assertEquals('Got unexpected type: "int_128"', $exception->getMessage());
    }
}