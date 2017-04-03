<?php

namespace ParameterValidator;

use Exception\FileDoesNotExistException;
use Exception\GotUnknownOptionTypeException;
use Exception\GotWrongVariableTypeException;
use Exception\MissingRequiredParameterException;
use Exception\ParameterIsNotAllowedException;
use Option\Option;
use Option\OptionInterface;

class ParameterValidator implements ParameterValidatorInterface
{

    /**
     * @var array
     */
    private $options = [];

    public final function addOption(OptionInterface $option) : ParameterValidatorInterface
    {
        //Add option
        $this->options[] = $option;

        return $this;
    }

    public final function checkForIllegalParameters(array $requestParameters)
    {
        foreach ($requestParameters as $parameterKey => $parameterValue){

            $options = array_filter($this->options, function(OptionInterface $option) use ($parameterKey){

                if($option->getOptionKey() === $parameterKey){
                    return true;
                }

                return false;
            });

            //When the options are empty it means that there was not element found which means no option was configured
            if (empty($options)) {
                throw new ParameterIsNotAllowedException($parameterKey);
            }

        }

        return;
    }

    public final function checkRequiredParameters(array $requestParameters)
    {

        /** @var OptionInterface $option */
        foreach ($this->options as $option){

            if(false === $option->isRequired()){
                continue;
            }

            if(false === array_key_exists($option->getOptionKey(), $requestParameters)){
                throw new MissingRequiredParameterException($option->getOptionKey());
            }
        }

        return;
    }

    public final function proveParameterValues(array $requestParameters)
    {

        /** @var OptionInterface $option */
        foreach ($this->options as $option){

            if(array_key_exists($option->getOptionKey(), $requestParameters)){
                $requestValue = $requestParameters[$option->getOptionKey()];
            }else{
                return;
            }

            switch ($option->getOptionType()){
                case Option::TYPE_FILE : {
                    if(false === is_file(realpath($requestValue))){
                        throw new FileDoesNotExistException(realpath($requestValue));
                    }
                    break;
                }
                case Option::TYPE_BOOL : {
                    if(false === is_bool($requestValue)){
                        throw new GotWrongVariableTypeException('bool', $option->getOptionKey());
                    }
                    break;
                }
                case Option::TYPE_STRING : {
                    if(false === is_string($requestValue)){
                        throw new GotWrongVariableTypeException('string', $option->getOptionKey());
                    }
                    break;
                }
                default : {
                    throw new GotUnknownOptionTypeException($option->getOptionType());
                }
            }

        }

    }

    public final function checkParameters(array $requestParameters)
    {
        $this->checkForIllegalParameters($requestParameters);
        $this->checkRequiredParameters($requestParameters);
        $this->proveParameterValues($requestParameters);

        return;
    }

    /**
     * @return array
     */
    public function getOptions() : array
    {
        return $this->options;
    }

}