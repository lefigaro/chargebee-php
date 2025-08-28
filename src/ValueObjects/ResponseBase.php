<?php

namespace Chargebee\ValueObjects;
define('v4_IDEMPOTENCY_REPLAY_HEADER', 'chargebee-idempotency-replayed');

class ResponseBase
{
    /**
     * @var array<string, string> $responseHeaders
     */
    protected ?array $responseHeaders;
    private ?array $rawResponseData;

    public function __construct(array $responseHeaders = [], array $rawResponseData = [])
    {
        $this->responseHeaders = $responseHeaders;
        $this->rawResponseData = $rawResponseData;
    }
    
    public function getResponseHeaders(): ?array
    {
        return $this->responseHeaders;
    }
    public function isIdempotencyReplayed(): bool
    {   
        $headers = $this->responseHeaders;
        if (isset($headers[v4_IDEMPOTENCY_REPLAY_HEADER])) {
            $value = $headers[v4_IDEMPOTENCY_REPLAY_HEADER][0];
            return  boolval($value);
        }
        return false;
    }

    public function getRawResponseData(): ?array { 
        return $this->rawResponseData;
    } 
}