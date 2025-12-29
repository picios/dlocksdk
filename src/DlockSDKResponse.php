<?php

namespace Picios\DlockSDK;

class DlockSDKResponse
{
    public function __construct(private string $responseContent, private int $httpCode)
    {
        // Initialization code here
    }

    public function getContent(): string
    {
        return $this->responseContent;
    }

    public function isSuccess(): bool
    {
        // Logic to determine if the response indicates success
        return !empty($this->responseContent) && $this->httpCode >= 200 && $this->httpCode < 300;
    }

    public function getData(): array
    {
        // Logic to parse response content into an array
        return json_decode($this->responseContent, true) ?? [];
    }
}