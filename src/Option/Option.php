<?php

namespace Option;

final class Option implements OptionInterface
{

    /**
     * @var string
     */
    private $optionType;

    /**
     * @var string
     */
    private $optionKey;

    /**
     * @var bool
     */
    private $required;

    /**
     * Option constructor.
     * @param string $optionType
     * @param string $optionKey
     * @param bool $required
     */
    public function __construct(string $optionType, string $optionKey, bool $required)
    {
        $this->optionType = $optionType;
        $this->optionKey = $optionKey;
        $this->required = $required;
    }

    /**
     * @return string
     */
    public function getOptionKey() : string
    {
        return $this->optionKey;
    }

    /**
     * @return bool
     */
    public function isRequired() : bool
    {
        return $this->required;
    }

    /**
     * @return string
     */
    public function getOptionType() : string
    {
        return $this->optionType;
    }

}