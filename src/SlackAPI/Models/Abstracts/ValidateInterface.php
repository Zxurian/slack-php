<?php

namespace SlackAPI\Models\Abstracts;

use SlackPHP\SlackAPI\Exceptions\SlackException;

interface ValidateInterface
{
    /**
     * Validate the model to make sure it has all of the required information
     * 
     * @throws SlackException
     */
    protected function validateModel();
}