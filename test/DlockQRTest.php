<?php

namespace Picios\DlockSDK\Test;

use PHPUnit\Framework\TestCase;
use Picios\DlockSDK\DlockSDKConnection;

class DlockConnectTest extends TestCase
{
    public function testConnect()
    {
        $connection = new DlockSDKConnection(
            'https://example.com',
            'partner_address_123'
        );

        $this->assertEquals('https://example.com', $connection->getBackendUrl());
        $this->assertEquals('partner_address_123', $connection->getPartnerAddress());
    }
}