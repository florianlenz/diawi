<?php

namespace ApiCallFactory;

use ApiCall\ApiCallInterface;
use ParameterValidator\ParameterValidatorInterface;

interface ApiCallFactoryInterface
{

    const METHOD_POST = "POST";

    const METHOD_GET = "GET";

    public function __construct(string $url, string $method, ParameterValidatorInterface $validator, array $options);

    public function getApiCall() : ApiCallInterface;
}