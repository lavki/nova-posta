<?php

namespace NovaPosta\Application\Validator;

/**
 * Class AbstractValidator
 * @package NovaPosta\Application\Validator
 */
abstract class AbstractValidator implements ValidatorInterface
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param string $param
     */
    abstract public function validate($param);

    /**
     * @return bool
     */
    public function isValid()
    {
        return empty($this->errors);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }
}