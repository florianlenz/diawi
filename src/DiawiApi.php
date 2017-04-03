<?php

namespace DiawiApi;

use ApiCallFactory\ApiCallFactory;
use ApiCallFactory\ApiCallFactoryInterface;
use Option\Option;
use ParameterValidator\ParameterValidator;
use ResponseTransformer\JsonToArrayResponseTransformer;
use ResponseTransformer\ResponseTransformerInterface;

class DiawiApi
{

    /**
     * @var string
     */
    private $apiKey;

    /**
     * DiawiApi constructor.
     * @param string $apiKey#
     */
    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param array $requestParameter
     * @param ResponseTransformerInterface|null $responseTransformer
     * @return ResponseTransformerInterface
     */
    public function upload(array $requestParameter, ResponseTransformerInterface $responseTransformer = null) : ResponseTransformerInterface
    {
        $requestParameter['token'] = $this->apiKey;

        //Validate parameter
        $paramValidator = new ParameterValidator();
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'token', true));
        $paramValidator->addOption(new Option(Option::TYPE_FILE, 'file', true));
        $paramValidator->addOption(new Option(Option::TYPE_BOOL, 'find_by_udid', false));
        $paramValidator->addOption(new Option(Option::TYPE_BOOL, 'wall_of_apps', false));
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'password', false));
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'comment', false));
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'callback_url', false));
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'callback_emails', false));
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'installation_notifications', false));

        //Create api call
        $apiCallFactory = new ApiCallFactory(
            'https://upload.diawi.com/',
            ApiCallFactoryInterface::METHOD_POST,
            $paramValidator,
            $requestParameter
        );

        //Call the api
        if($responseTransformer instanceof ResponseTransformerInterface){
            return $apiCallFactory->getApiCall()->request($responseTransformer);
        }

        return $apiCallFactory->getApiCall()->request(new JsonToArrayResponseTransformer());

    }

    public function status(array $requestParameter, ResponseTransformerInterface $responseTransformer = null) : ResponseTransformerInterface
    {
        $requestParameter['token'] = $this->apiKey;

        //Validate parameter
        $paramValidator = new ParameterValidator();
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'token', true));
        $paramValidator->addOption(new Option(Option::TYPE_STRING, 'job', true));

        //Create api call
        $apiCallFactory = new ApiCallFactory(
            'https://upload.diawi.com/status',
            ApiCallFactoryInterface::METHOD_GET,
            $paramValidator,
            $requestParameter
        );

        //Call the api
        if($responseTransformer instanceof ResponseTransformerInterface){
            return $apiCallFactory->getApiCall()->request($responseTransformer);
        }

        return $apiCallFactory->getApiCall()->request(new JsonToArrayResponseTransformer());


    }

}