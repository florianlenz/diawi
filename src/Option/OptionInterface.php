<?php

namespace Option;

interface OptionInterface
{
    const TYPE_STRING = 'type.string';

    const TYPE_FILE = 'type.file';

    const TYPE_BOOL = 'type.bool';

    public function __construct(string $optionType, string $optionKey, bool $required);

    public function getOptionKey() : string;

    public function isRequired() : bool;

    public function getOptionType() : string;
}