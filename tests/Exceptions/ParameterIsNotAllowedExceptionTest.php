<?php

namespace tests\Exceptions;

use Exception\ParameterIsNotAllowedException;
use PHPUnit\Framework\TestCase;

class ParameterIsNotAllowedExceptionTest extends TestCase
{
    public function testExceptionMessage()
    {
        $exception = new ParameterIsNotAllowedException('foo');

        $this->assertEquals('The option: "foo" is not allowed.', $exception->getMessage());
    }
}