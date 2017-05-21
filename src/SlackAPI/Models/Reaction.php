<?php

namespace SlackPHP\SlackAPI\Models;

use JMS\Serializer\Annotation\Type;
use SlackPHP\SlackAPI\Models\AbstractModels\MagicGetter;

/**
 * Model of Reaction
 *
 * @author Dzianis Zhaunerchyk <dzhaunerchyk@gmail.com>
 * @see https://api.slack.com/types/file
 * @package SlackAPI
 * @version 0.2
 * 
 * @method string getName()
 * @method int getCount()
 * @method array getUsers()
 */

class Reaction extends MagicGetter
{
    /**
     * @var string
     * @Type("string")
     */
    protected $name = null;

    /**
     * @var int
     * @Type("integer")
     */
    protected $count = null;

    /**
     * @var array
     * @Type("array<string>")
     */
    protected $users = null;
}