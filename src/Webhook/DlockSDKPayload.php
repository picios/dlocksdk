<?php

namespace Picios\DlockSDK\Webhook;

class DlockSDKPayload
{
    private array $payloadData;

    public function __construct(private string $payload)
    {
        $this->payloadData = $this->toArray($payload);
    }

    public function getData(): array
    {
        return $this->payloadData;
    }

    private function getValue(string $key): mixed
    {
        return $this->payloadData[$key] ?? null;
    }

    private function toArray(string $payload): array
    {
        return json_decode($payload, true) ?? [];
    }

    public function getSessionId(): ?string
    {
        return $this->getValue('sessionId');
    }

    public function getDHCAddress(): ?string
    {
        return $this->getValue('userDHCAddress');
    }

    public function getStatus(): ?string
    {
        return $this->getValue('status');
    }

    public function getIntent(): ?string
    {
        return $this->getValue('intent');
    }
}