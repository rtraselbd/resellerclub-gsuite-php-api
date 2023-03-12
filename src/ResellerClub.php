<?php

namespace RT\ResellerClub;

use RT\ResellerClub\APIs\Orders;
use RT\ResellerClub\APIs\GSuite;
use RT\ResellerClub\APIs\Customers;

/**
 * Class ResellerClub
 *
 * @package RT\ResellerClub
 */
class ResellerClub
{
    public const API_URL = 'https://httpapi.com/api/';
    public const API_TEST_URL = 'https://test.httpapi.com/api/';

    private $baseURL;

    /**
     * List of API classes
     *
     * @var array
     */
    private $apiList = [];

    /**
     * Authentication info needed for every request
     *
     * @var array
     */
    private $authentication = [];

    /**
     * ResellerClub constructor.
     *
     * @param int    $userId
     * @param string $apiKey
     * @param bool   $testMode
     *
     * @return void
     */
    public function __construct(
        $userId,
        $apiKey,
        $testMode = false
    ) {
        $this->authentication = [
            'auth-userid' => $userId,
            'api-key'     => $apiKey,
        ];

        $this->baseURL = $testMode ? self::API_TEST_URL : self::API_URL;
    }

    /**
     * @param $api
     *
     * @return mixed
     */
    private function _getAPI($api)
    {
        if (empty($this->apiList[$api])) {
            $class = 'RT\\ResellerClub\\APIs\\' . $api;
            $this->apiList[$api] = new $class(
                $this->baseURL,
                $this->authentication
            );
        }

        return $this->apiList[$api];
    }

    /**
     * @return GSuite
     */
    public function gsuite()
    {
        return $this->_getAPI('GSuite');
    }

    /**
     * @return Orders
     */
    public function orders()
    {
        return $this->_getAPI('Orders');
    }
    /**
     * @return Customers
     */
    public function customers()
    {
        return $this->_getAPI('Customers');
    }
}
