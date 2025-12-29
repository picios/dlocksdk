<?php

namespace RewolWeb\DlockSDK\Test;

use PHPUnit\Framework\TestCase;
use RewolWeb\DlockSDK\DlockSDKConnect;
use RewolWeb\DlockSDK\Request\DlockSDKAuth;

class DlockConnectTest extends TestCase
{
    public function testConnect()
    {
        $connect = new DlockSDKConnect(
            'https://example.com',
            'partner_address_123'
        );

        $this->assertEquals('https://example.com', $connect->getBackendUrl());
        $this->assertEquals('partner_address_123', $connect->getPartnerAddress());
    }
}