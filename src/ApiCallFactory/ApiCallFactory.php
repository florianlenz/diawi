<?php

namespace ApiCallFactory;
use ApiCall\ApiCall;
use ApiCall\ApiCallInterface;
use Option\Option;
use Option\OptionInterface;
use ParameterValidator\ParameterValidatorInterface;

class ApiCallFactory implements ApiCallFactoryInterface
{

    /**
     * @var ParameterValidatorInterface
     */
    private $paramValidator;

    /**
     * @var array
     */
    private $requestParameter;

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $method;

    /**
     * ApiCallFactory constructor.
     * @param string $url
     * @param string $method
     * @param ParameterValidatorInterface $validator
     * @param array $requestParameter
     */
    public function __construct(string $url, string $method, ParameterValidatorInterface $validator, array $requestParameter)
    {
        $this->paramValidator = $validator;
        $this->requestParameter = $requestParameter;
        $this->url = $url;
    }

    public final function transformRequestParameters() : array
    {
        //options
        $apiCallOptions = $this->paramValidator->getOptions();

        //Filter file options
        $fileTypeOptions = array_filter($apiCallOptions, function(OptionInterface $option){
            if ($option->getOptionType() === Option::TYPE_FILE){
                return true;
            }
            return false;
        });

        //Transform file options
        /** @var OptionInterface $fileTypeOption */
        foreach ($fileTypeOptions as $fileTypeOption){
            $optionKey = $fileTypeOption->getOptionKey();

            if(false === array_key_exists($optionKey, $this->requestParameter)){
                continue;
            }

            $this->requestParameter[$optionKey] = new \CURLFile($this->requestParameter[$optionKey]);
        }

        //Filter bool options
        $boolTypeOptions = array_filter($apiCallOptions, function(OptionInterface $option){
            if ($option->getOptionType() === Option::TYPE_BOOL){
                return true;
            }
            return false;
        });

        //Transform bool options
        /** @var OptionInterface $boolTypeOption */
        foreach ($boolTypeOptions as $boolTypeOption){
            $optionKey = $boolTypeOption->getOptionKey();

            if(false === array_key_exists($optionKey, $this->requestParameter)){
                continue;
            }

            $this->requestParameter[$optionKey] = (int) $this->requestParameter[$optionKey];
        }

        return $this->requestParameter;
    }

    public function getApiCall() : ApiCallInterface
    {
        //Validate Request parameter
        $this->paramValidator->checkParameters($this->requestParameter);

        //Transform request parameters
        $this->transformRequestParameters();

        $curlRes = curl_init();
        curl_setopt($curlRes, CURLOPT_URL, $this->url);
        curl_setopt($curlRes, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curlRes, CURLOPT_CUSTOMREQUEST, $this->method);
        curl_setopt($curlRes, CURLOPT_POSTFIELDS, $this->requestParameter);

        return new ApiCall($curlRes);
    }
}