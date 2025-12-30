<?php

namespace Picios\DlockSDK\Request;

use Picios\DlockSDK\DlockSDKConnection;
use Picios\DlockSDK\DlockSDKResponse;
use Picios\DlockSDK\DlockSDKSession;

class DlockSDKAuth
{
    public function __construct(private DlockSDKConnection $dlockSdkConnection)
    {
        // Constructor code here
    }

    public function postPinEntered(string $pin, ?string $webHookUrl = null): DlockSDKResponse
    {
        return $this->dlockSdkConnection->post('/postDlockPINEntered', [
            'partnerDHCAddress' => $this->dlockSdkConnection->getPartnerAddress(),
            'intent' => 'LOGIN',
            'webHookUrl' => $webHookUrl,
            'PIN' => $pin,
        ]);
    }

    public function getSessionStatus(string $sessionId): DlockSDKResponse
    {
        return $this->dlockSdkConnection->get('/getDLockSessionStatus', [
            'sessionId' => $sessionId,
        ]);
    }

    public function getQRcodeImage(?string $sessionId = null, ?string $webHookUrl = null): DlockSDKResponse
    {
        if ($sessionId === null) {
            $sessionId = DlockSDKSession::generateSessionId();
        }
        return $this->dlockSdkConnection->get('/getDlockQRcodeImage', [
            'partnerDHCAddress' => $this->dlockSdkConnection->getPartnerAddress(),
            'intent' => 'LOGIN',
            'webHookUrl' => $webHookUrl,
            'sessionId' => $sessionId,
        ]);
    }

    public function getDHCAFromQuery(array $payload): ?string
    {
        //$sessionId = $payload['sessionId'];
        //$status = $payload['status'];
        //$userDHCAddress = $payload['userDHCAddress'] ?? null;
        //$intent = $payload['intent'] ?? 'LOGIN';
        return $payload['DHCAddress'] ?? null;
    }

}