<?php

namespace RewolWeb\DlockSDK\Request;

use RewolWeb\DlockSDK\DlockSDKConnect;
use RewolWeb\DlockSDK\DlockSDKResponse;

class DlockSDKAuth
{
    public function __construct(private DlockSDKConnect $dlockSdkConnect)
    {
        // Constructor code here
    }

    public function postPinEntered(string $pin, ?string $webHookUrl = null): DlockSDKResponse
    {
        return $this->dlockSdkConnect->post('/postDlockPINEntered', [
            'partnerDHCAddress' => $this->dlockSdkConnect->getPartnerAddress(),
            'intent' => 'LOGIN',
            'webHookUrl' => $webHookUrl,
            'PIN' => $pin,
        ]);
    }

    public function getSessionStatus(string $sessionId): DlockSDKResponse
    {
        return $this->dlockSdkConnect->get('/getDLockSessionStatus', [
            'sessionId' => $sessionId,
        ]);
    }

    public function getQRcodeImage(string $sessionId, ?string $webHookUrl = null): DlockSDKResponse
    {
        return $this->dlockSdkConnect->get('/getDlockQRcodeImage', [
            'partnerDHCAddress' => $this->dlockSdkConnect->getPartnerAddress(),
            'intent' => 'LOGIN',
            'webHookUrl' => $webHookUrl,
            'sessionId' => $sessionId,
        ]);
    }

}