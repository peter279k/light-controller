<?php

namespace lee;

use function sprintf;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Message;
use GuzzleHttp\Exception\ClientException;

class Light
{
    private $serviceKey;
    private $jsonPayload;
    private $eventName;

    public function __construct(string $serviceKey, string $eventName, array $jsonPayload=[])
    {
        $this->serviceKey = $serviceKey;
        $this->jsonPayload = $jsonPayload;
        $this->eventName = $eventName;
    }

    public  function sendRequest()
    {
        $client = new Client();
        $serviceUrl = sprintf('https://maker.ifttt.com/trigger/%s/json/with/key/%s',
            $this->eventName,
            $this->serviceKey
        );
        try {
            if (count($this->jsonPayload) === 0) {
                return $client->request('GET', $serviceUrl);
            }

            return $client->request('POST', $serviceUrl, [
                'json' => $this->jsonPayload,
            ]);
        } catch (ClientException $e) {
            return [
                'request' => Message::toString($e->getRequest()),
                'response' => Message::toString($e->getResponse()),
            ];
        }
    }
}
