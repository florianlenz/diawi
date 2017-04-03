<?php

namespace tests\Exceptions;

use Exception\GotWrongVariableTypeException;
use PHPUnit\Framework\TestCase;

class GotWrongVariableTypeExceptionTest extends TestCase
{
    public function testMessage()
    {
        $exception = new GotWrongVariableTypeException('bool', 'key_');

        $this->assertEquals('Expect type of "bool" for key: "key_"', $exception->getMessage());
    }
}