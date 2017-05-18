<?php

namespace SlackPHP\SlackAPI\Main;

use SlackPHP\SlackAPI\Exceptions\SlackException;
use GuzzleHttp\ClientInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use SlackPHP\SlackAPI\Processors\PayloadResponseProcessor;
use GuzzleHttp\Client;
use Symfony\Component\EventDispatcher\EventDispatcher;
use SlackPHP\SlackAPI\Events\RequestEvent;
use GuzzleHttp\Psr7\Request;
use SlackPHP\SlackAPI\Events\ReceivedEvent;
use SlackPHP\SlackAPI\Events\ParsedReceivedEvent;
use Doctrine\Common\Annotations\AnnotationRegistry;
use SlackPHP\SlackAPI\Models\AbstractModels\AbstractPayload;
use SlackPHP\SlackAPI\Models\AbstractModels\AbstractPayloadResponse;

/**
 * Class where the calls to Slack API are executed from
 * Provide payload to send method for sending it to Slack API
 * 
 * @author Dzianis Zhaunerchyk <dzhaunerchyk@gmail.com>
 */
class SlackAPI
{
    /**
     * @var string|NULL
     */
    private $token = null;
    
    /**
     * @var PayloadResponseProcessor|NULL
     */
    private $payloadResponseProcessor = null;
    
    /**
     * @var ClientInterface|NULL
     */
    private $client = null;
    
    /**
     * @var EventDispatcherInterface|NULL
     */
    private $eventDispatcher = null;
    
    /**
     * Base URL for Slack API
     */
    const API_URL = 'https://slack.com/api/';
    
    /**
     * @param string|null $token
     * @param ClientInterface|null $client
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct($token = null, ClientInterface $client = null, EventDispatcherInterface $eventDispatcher = null) 
    {
        if (is_scalar($token)) {
            $this->token = (string)$token;
        }
        
        if ($token !== null) {
            throw new SlackException('Auth Token has to be set before sending payload', SlackException::NO_TOKEN_SET);
        }
        
        if ($client === null) {
            $this->client = new Client();
        }
        
        if ($eventDispatcher === null) {
            $this->eventDispatcher = new EventDispatcher();
        }
        
        $this->payloadResponseProcessor = new PayloadResponseProcessor();
    }
    
    /**
     * Send payload to Slack API
     * 
     * @param AbstractPayload $payload Payload to send
     * @return AbstractPayloadResponse
     */
    public function send(AbstractPayload $payload)
    {
        if ($payload->getToken() === null) {
            $payload->setToken($this->token);
        }
        
        $preparedPayload = $payload->preparePayloadForSlack();
        
        $requestEvent = new RequestEvent();
        $requestEvent
            ->setPayload($payload)
            ->setPreparedPayload($preparedPayload)
        ;
        
        $this->eventDispatcher->dispatch(RequestEvent::EVENT_NAME, $requestEvent);
        $request = new Request(
            'POST',
            self::API_URL . $payload->getMethod(),
            ['Content-Type' => 'application/x-www-form-urlencoded'],
            http_build_query($preparedPayload)
        );
        $response = $this->client->send($request);
        $receivedEvent = new ReceivedEvent();
        $receivedEvent
            ->setPayload($payload)
            ->setResponse($response)
        ;
        $this->eventDispatcher->dispatch(ReceivedEvent::EVENT_NAME, $receivedEvent);
        
        if ($response->getStatusCode() != 200) {
            throw new SlackException('Received status code should be 200, received: '.$response->getStatusCode(), SlackException::NOT_200_FROM_SLACK_SERVER);
        }
        
        $payloadResponseObject = $payload->getResponseClass()::parseResponse($response->getBody()->getContents());
        $parsedReceivedEvent = new ParsedReceivedEvent();
        $parsedReceivedEvent
            ->setPayload($payload)
            ->setPayloadResponse($payloadResponseObject)
        ;
        $this->eventDispatcher->dispatch(ParsedReceivedEvent::EVENT_NAME, $parsedReceivedEvent);
        
        return $payloadResponseObject;
    }
}