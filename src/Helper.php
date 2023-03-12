<?php

namespace RT\ResellerClub;

use Exception;

/**
 * Trait Helper
 * @package RT\ResellerClub
 */

trait Helper
{
    private $baseURL;
    private $curl = NULL;

    /**
     * Curl Options
     *
     * @var array
     */

    private $curlOptions = [];

    /**
     * Authentication info needed for every request
     *
     * @var array
     */

    private $authentication = [];

    public function __construct($baseURL, $authentication)
    {
        $this->baseURL = $baseURL;
        $this->authentication = $authentication;
        $this->curl = curl_init();
        $this->setCurlOption(CURLOPT_RETURNTRANSFER, true);
    }

    public function __destruct()
    {
        curl_close($this->curl);
    }
    protected function setCurlOption($option, $value)
    {
        $this->curlOptions[$option] = $value;
    }

    protected function get($method, $args = [], $prefix = '')
    {
        if (!empty($prefix)) {
            $callURL = $this->baseURL . $this->api . '/' . $prefix . '/' . $method . '.json';
        } else {
            $callURL = $this->baseURL . $this->api . '/' . $method . '.json';
        }

        try {
            $this->setCurlOption(CURLOPT_URL, $callURL . '?' . preg_replace(
                '/%5B[0-9]+%5D/simU',
                '',
                http_build_query(
                    array_merge($args, $this->authentication)
                )
            ));
            $this->setCurlOption(CURLOPT_HTTPGET, true);
            $this->setCurlOption(CURLOPT_CUSTOMREQUEST, "GET");
            return $this->executeRequest();
        } catch (Exception $error) {
            return ['status' => 'error', 'message' => $error->getMessage()];
        }
    }
    protected function post($method, $args = [], $prefix = '')
    {
        if (!empty($prefix)) {
            $callURL = $this->baseURL . $this->api . '/' . $prefix . '/' . $method . '.json';
        } else {
            $callURL = $this->baseURL . $this->api . '/' . $method . '.json';
        }

        try {
            $this->setCurlOption(CURLOPT_URL, $callURL);
            $this->setCurlOption(CURLOPT_POST, true);
            $this->setCurlOption(CURLOPT_CUSTOMREQUEST, "POST");
            $this->setCurlOption(CURLOPT_POSTFIELDS, http_build_query(
                array_merge($args, $this->authentication)
            ));
            return $this->executeRequest();
        } catch (Exception $error) {
            return ['status' => 'error', 'message' => $error->getMessage()];
        }
    }

    protected function executeRequest()
    {
        curl_setopt_array($this->curl, $this->curlOptions);
        $response = curl_exec($this->curl);
        return json_decode($response, true);
    }
}
