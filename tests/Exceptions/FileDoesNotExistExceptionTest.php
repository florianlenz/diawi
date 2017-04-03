<?php

namespace tests\Exceptions;

use Exception\FileDoesNotExistException;
use PHPUnit\Framework\TestCase;

class FileDoesNotExistExceptionTest extends TestCase
{
    public function testMessage()
    {
        $exception = new FileDoesNotExistException('app_build.ipa');

        $this->assertEquals('The File: "app_build.ipa" does not exist', $exception->getMessage());
    }
}