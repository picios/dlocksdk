<?php

namespace Picios\DlockSDK;

class DlockSDKConnection
{

    public function __construct(private string $dlockBackendUrl, private string $dlockPartnerAddress)
    {
        
    }

    public function getBackendUrl(): string
    {
        return $this->dlockBackendUrl;
    }

    public function getPartnerAddress(): string
    {
        return $this->dlockPartnerAddress;
    }

    /* 
    # for later use
    private function authenticate(&$curl, string $username, string $password)
    {
        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "{$username}:{$password}");
    }
    */

    private function formatResponse(string $response, int $httpcode): DlockSDKResponse
    {
        return new DlockSDKResponse(trim($response), $httpcode);
    }

    public function post(string $endpointUri, array $data): DlockSDKResponse
    {
        return $this->sendRequest("POST", $this->getBackendUrl() . $endpointUri, $data);
    }

    public function get(string $endpointUri, array $data): DlockSDKResponse
    {
        return $this->sendRequest("GET", $this->getBackendUrl() . $endpointUri, $data);
    }

    private function sendRequest($method, $url, ?array $data = null): DlockSDKResponse
    {

        $curl = curl_init();

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data != null)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data != null)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //$this->authenticate($curl, 'username', 'password');

        $result = curl_exec($curl);
        $httpcode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        return $this->formatResponse($result, $httpcode);
    }

}