<?php

namespace tests\ParameterValidator;

use Exception\FileDoesNotExistException;
use Exception\GotWrongVariableTypeException;
use Exception\MissingRequiredParameterException;
use Exception\ParameterIsNotAllowedException;
use Option\Option;
use Option\OptionInterface;
use ParameterValidator\ParameterValidator;
use PHPUnit\Framework\TestCase;

class ParameterValidatorTest extends TestCase
{
    public function testAddOption()
    {
        //Create dummy option
        $option = new Option(Option::TYPE_STRING, 'foo', 'bar', false);

        //Create parameter validator
        $parameterValidator = new ParameterValidator();

        //Add dummy option
        $parameterValidator->addOption($option);

        /**
         * Assert that the dummy option and the first element of the options array in the parameter validator
         * are equals
         */
        $this->assertEquals($option, $parameterValidator->getOptions()[0]);
    }

    public function testCheckForIllegalParametersException()
    {
        //Expect illegal parameter exception
        $this->expectException(ParameterIsNotAllowedException::class);

        //Create dummy option
        $option = new Option(Option::TYPE_STRING, 'foo', 'bar', false);

        //Create parameter validator
        $parameterValidator = new ParameterValidator();

        //Add option
        $parameterValidator->addOption($option);

        //Passing not configured parameter key which was not configured via the ->addOption method
        $parameterValidator->checkForIllegalParameters(['i_am_illigal' => 'fake']);
    }

    public function testCheckForIllegalParametersNoException()
    {
        //Create dummy option
        $option = new Option(Option::TYPE_STRING, 'foo', 'bar', false);

        //Create parameter validator
        $parameterValidator = new ParameterValidator();

        //Add option
        $parameterValidator->addOption($option);

        //Passing not configured parameter key which was not configured via the ->addOption method
        $parameterValidator->checkForIllegalParameters(['foo' => 'some value']);
    }

    public function testCheckRequiredParametersForRequiredField()
    {

        $this->expectException(MissingRequiredParameterException::class);

        //Create dummy option
        $option = new Option(Option::TYPE_STRING, 'foo', 'bar', true);

        //Create parameter validator
        $parameterValidator = new ParameterValidator();
        $parameterValidator->addOption($option);

        //Checking if the
        $parameterValidator->checkRequiredParameters(['some_key' => 'd']);
    }

    public function testCheckRequiredParametersForNonRequiredField()
    {
        $option = new Option(Option::TYPE_STRING, 'foo', false);

        //Create parameter validator
        $parameterValidator = new ParameterValidator();
        $parameterValidator->addOption($option);

        //Checking if the
        $parameterValidator->checkRequiredParameters(['some_key' => 'yeah']);
    }

    /**
     * @param OptionInterface $option
     * @param array $requestParameter
     * @param bool $expectException
     * @param string $exception
     * @dataProvider proveParameterDataProvider
     */
    public function testProveParameter(OptionInterface $option, array $requestParameter, bool $expectException, $exception = '')
    {

        //Add expect exception to test
        if(true === $expectException){
            $this->expectException($exception);
        }

        $parameterValidator = new ParameterValidator();
        $parameterValidator->addOption($option);
        $parameterValidator->proveParameterValues($requestParameter);
    }

    public function proveParameterDataProvider()
    {
        return [
            'one' => [
                new Option(Option::TYPE_STRING, 'api_key', false),
                ['api_key' => 3],
                true,
                GotWrongVariableTypeException::class
            ],
            'two' => [
                new Option(OptionInterface::TYPE_STRING, 'api_key', false),
                ['api_key' => 'i_am_so_secret'],
                false,
            ],
            'three' => [
                new Option(OptionInterface::TYPE_BOOL, 'send_notification', false),
                ['send_notification' => 'i_am_not_a_bool'],
                true,
                GotWrongVariableTypeException::class
            ],
            'four' => [
                new Option(OptionInterface::TYPE_BOOL, 'send_notification', false),
                ['send_notification' => false],
                false
            ],
            'five' => [
                new Option(OptionInterface::TYPE_FILE, 'build_file', false),
                ['build_file' => 'fake.ipa'],
                true,
                FileDoesNotExistException::class
            ],
            'six' => [
                new Option(OptionInterface::TYPE_FILE, 'build_file', false),
                ['build_file' => realpath(__DIR__).'/dummy.ipa'],
                false
            ]
        ];
    }

}