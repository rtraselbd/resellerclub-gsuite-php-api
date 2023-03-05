<?php

namespace RT\ResellerClub\APIs;

use Exception;
use RT\ResellerClub\Helper;

/**
 * Class GSuite
 *
 * @package RT\ResellerClub\APIs
 * @todo    Check all the APIs parameters there are some changes.
 */
class GSuite
{
    use Helper;

    /**
     * @var string
     */
    protected $api = 'gapps';

    /**
     * @param string $domainName
     * @param int $months
     * @param int $noOfAccounts
     * @param int $customerId
     * @param string $invoice Available options [NoInvoice, PayInvoice, KeepInvoice, OnlyAdd]
     * @param int $loaction Available options [1 = India, 2 = South East Asia & Egypt, 3 = Global]
     * @param int $planId India, South East Asia & Egypt, Global [Business Starter = (1660,1663,1657), Business Standard = (1661,1664,1658), Business Plus = (1662,1665,1659), Enterprise Plus = (1554, 1560, 1557)]
     *
     * @return array|Exception
     * @throws Exception
     * @link https://manage.logicboxes.com/kb/answer/2711
     */
    public function add(
        $domainName,
        $months,
        $noOfAccounts,
        $customerId,
        $invoice,
        $loaction = 3,
        $planId = 1657
    ) {
        $method = $this->getLocation($loaction, 'add');
        return $this->post(
            $method,
            [
                'domain-name'       => $domainName,
                'months'            => $months,
                'no-of-accounts'    => $noOfAccounts,
                'customer-id'       => $customerId,
                'invoice-option'    => $invoice,
                'plan-id'           => $planId
            ]
        );
    }

    /**
     * @param int $orderId
     * @param string $email
     * @param string $password
     * @param string $firstName
     * @param string $lastName
     * @param string $altEmail
     * @param string $customerName
     * @param string $company
     * @param string $zip
     * @param int $loaction Available options [1 = India, 2 = South East Asia & Egypt, 3 = Global]
     *
     * @return array|Exception
     * @throws Exception
     * @link https://manage.logicboxes.com/kb/answer/2713
     */
    public function addAdmin(
        $orderId,
        $email,
        $password,
        $firstName,
        $lastName,
        $altEmail,
        $customerName,
        $company,
        $zip,
        $loaction = 3
    ) {
        $method = $this->getLocation($loaction, 'admin/add');
        return $this->post(
            $method,
            [
                'order-id'                  => $orderId,
                'email-address'             => $email,
                'password'                  => $password,
                'first-name'                => $firstName,
                'last-name'                 => $lastName,
                'alternate-email-address'   => $altEmail,
                'name'                      => $customerName,
                'company'                   => $company,
                'zip'                       => $zip
            ]
        );
    }

    /**
     * @param int $orderId
     * @param int $months
     * @param string $invoice Available options [NoInvoice, PayInvoice, KeepInvoice, OnlyAdd]
     * @param int $loaction Available options [1 = India, 2 = South East Asia & Egypt, 3 = Global]
     *
     * @return array|Exception
     * @throws Exception
     * @link https://manage.logicboxes.com/kb/answer/2712
     */
    public function renew(
        $orderId,
        $months,
        $invoice,
        $loaction = 3,
    ) {
        $method = $this->getLocation($loaction, 'renew');
        return $this->post(
            $method,
            [
                'order-id'          => $orderId,
                'months'            => $months,
                'invoice-option'    => $invoice
            ]
        );
    }

    /**
     * @param string $orderId
     * @param int $noOfAccounts
     * @param string $invoice Available options [NoInvoice, PayInvoice, KeepInvoice, OnlyAdd]
     * @param int $loaction Available options [1 = India, 2 = South East Asia & Egypt, 3 = Global]
     *
     * @return array|Exception
     * @throws Exception
     * @link https://manage.logicboxes.com/kb/answer/2711
     */
    public function addAccount(
        $orderId,
        $noOfAccounts,
        $invoice,
        $loaction = 3
    ) {
        $method = $this->getLocation($loaction, 'add-account');
        return $this->post(
            $method,
            [
                'order-id'          => $orderId,
                'no-of-accounts'    => $noOfAccounts,
                'invoice-option'    => $invoice
            ]
        );
    }


    /**
     * @param string $orderId
     * @param int $loaction Available options [1 = India, 2 = South East Asia & Egypt, 3 = Global]
     *
     * @return array|Exception
     * @throws Exception
     * @link https://manage.logicboxes.com/kb/answer/2711
     */
    public function delete(
        $orderId,
        $loaction = 3
    ) {
        $method = $this->getLocation($loaction, 'delete');
        return $this->post(
            $method,
            [
                'order-id'          => $orderId
            ]
        );
    }
}
