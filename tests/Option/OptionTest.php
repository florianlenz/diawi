<?php

namespace tests\Option;

use Option\Option;
use PHPUnit\Framework\TestCase;

class OptionTest extends TestCase
{
    public function testGetter()
    {
        $option = new Option(Option::TYPE_STRING, 'option_key', true);

        $this->assertEquals(Option::TYPE_STRING, $option->getOptionType());
        $this->assertEquals('option_key', $option->getOptionKey());
        $this->assertTrue($option->isRequired());
    }
}