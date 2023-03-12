<?php

namespace RT\ResellerClub\APIs;

use RT\ResellerClub\Helper;

/**
 * Class Customers
 *
 * @package RT\ResellerClub\APIs
 * @todo    Check all the APIs parameters there are some changes.
 */

class Customers
{
    use Helper;

    protected $api = 'customers';


    /**
     * @param int $email
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/874
     */

    public function details($email)
    {
        return $this->get(
            'details',
            [
                'username' => $email
            ]
        );
    }

    /**
     * Creates a Customer Account using the details provided.
     *
     * @param string $username
     * @param string $passwd
     * @param string $name
     * @param string $company
     * @param string $address
     * @param string $city
     * @param string $state
     * @param string $country
     * @param string $zipCode
     * @param string $phoneCC
     * @param string $phone
     * @param string $lang
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/node/804
     * @todo Check documents there is some updates in this method parameters
     */

    public function add(
        $username,
        $passwd,
        $name,
        $company,
        $address,
        $city,
        $state,
        $country,
        $zipCode,
        $phoneCC,
        $phone,
        $lang
    ) {
        return $this->post(
            'signup',
            [
                'username'       => $username,
                'passwd'         => $passwd,
                'name'           => $name,
                'company'        => $company,
                'address-line-1' => $address,
                'city'           => $city,
                'state'          => $state,
                'country'        => $country,
                'zipcode'        => $zipCode,
                'phone-cc'       => $phoneCC,
                'phone'          => $phone,
                'lang-pref'      => $lang,
            ],
            'v2'
        );
    }
}
