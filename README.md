

# DLockSDK

This library helps to connect to DLock API with PHP

## Installation

Install with composer

```
composer require picios/dlocksdk
```
## Usage

### Creating a new token
You need to create the token first, to  e.g. send it as a query parameter in en email message

``` php
<?php

use Picios\DlockSDK\DlockSDKConnection;
use Picios\DlockSDK\Request\DlockSDKAuth;

require_once __DIR__ . '/vendor/autoload.php';
$connection = new DlockSDKConnection(
        'https://example.com',
        'partner_address_123'
);

$auth = new DlockSDKAuth($connection);
$response = $auth->getQRcodeImage(
    'session_id',
    'https://example.com/webhook/123'
);

if ($response->isSuccess()) {
    die($response->getContent());
}
```

## Testing

To test the class, run:
```
phpunit test
```

