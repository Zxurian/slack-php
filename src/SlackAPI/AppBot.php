<?php

namespace SlackPHP\SlackAPI;

use SlackPHP\SlackAPI\Enumerators\Method;
use SlackPHP\SlackAPI\Models\Abstracts\AbstractPayload;
use SlackPHP\SlackAPI\Exceptions\SlackException;
use SlackPHP\SlackAPI\Models\Abstracts\AbstractPayloadResponse;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;

/**
 * Class where the calls to Slack API using bot OAuth token are executed from
 * Provide payload to send method as App Bot
 * 
 * @author Dzianis Zhaunerchyk <dzhaunerchyk@gmail.com>
 * @see https://api.slack.com/bot-users#method_list
 */
class AppBot extends SlackAPI
{
    /**
     * @var string|NULL
     */
    protected $token = null;
    
    /**
     * Base URL for Slack API
     */
    const API_URL = 'https://slack.com/api/';
    
    /**
     * @param string|null $token
     * @param ClientInterface|null $client
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    protected function __construct($token = null, ClientInterface $client = null, EventDispatcherInterface $eventDispatcher = null) 
    {
        if (!is_scalar($token) && $token === null) {
            throw new SlackException('Token should be scalar type', SlackException::NOT_SCALAR);
        } else {
            $this->token = (string)$token;
        }
        
        if ($client === null) {
            $this->client = new Client();
        } else {
            $this->client = $client;
        }
        
        if ($eventDispatcher === null) {
            $this->eventDispatcher = new EventDispatcher();
        } else {
            $this->eventDispatcher = $eventDispatcher;
        }
    }
    
    /**
     * Send payload with App Bot
     * 
     * @param AbstractPayload $payload
     * @throws SlackException
     * @return AbstractPayloadResponse
     */
    public function send(AbstractPayload $payload) 
    {
        if (!Method::isAvailableToBot($payload->getMethod())) {
            throw new SlackException('The method provided can’t be used by App Bot', SlackException::INVALID_METHOD);
        }
        
        return parent::send($payload);
    }
}