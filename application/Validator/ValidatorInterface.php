<?php

namespace NovaPosta\Application\Validator;

/**
 * Interface ValidatorInterface
 * @package NovaPosta\Application\Validator
 */
interface ValidatorInterface
{
    /**
     * @param string $param
     */
    public function validate($param);
}