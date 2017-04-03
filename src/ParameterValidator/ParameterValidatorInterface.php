<?php

namespace ParameterValidator;

use Option\OptionInterface;

interface ParameterValidatorInterface
{
    public function addOption(OptionInterface $option) : self;

    public function checkForIllegalParameters(array $requestParameters);

    public function checkRequiredParameters(array $requestParameters);

    public function checkParameters(array $requestParameters);

    public function proveParameterValues(array $requestParameters);

    public function getOptions() : array;

}