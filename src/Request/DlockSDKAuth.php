<?php

namespace Picios\DlockSDK\Request;

use Picios\DlockSDK\DlockSDKConnection;
use Picios\DlockSDK\DlockSDKResponse;

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

    public function getQRcodeImage(string $sessionId, ?string $webHookUrl = null): DlockSDKResponse
    {
        return $this->dlockSdkConnection->get('/getDlockQRcodeImage', [
            'partnerDHCAddress' => $this->dlockSdkConnection->getPartnerAddress(),
            'intent' => 'LOGIN',
            'webHookUrl' => $webHookUrl,
            'sessionId' => $sessionId,
        ]);
    }

}