<?php

namespace RT\ResellerClub\APIs;

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

    protected $api = 'gapps';


    /**
     * @param string $domainName
     * @param int $months
     * @param int $noOfAccounts
     * @param int $customerId
     * @param string $invoice Available options [NoInvoice, PayInvoice, KeepInvoice, OnlyAdd]
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     * @param int $planId India, South East Asia & Egypt, Global [Business Starter = (1660,1663,1657), Business Standard = (1661,1664,1658), Business Plus = (1662,1665,1659), Enterprise Plus = (1554, 1560, 1557)]
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/2711
     */

    public function add(
        $domainName,
        $months,
        $noOfAccounts,
        $customerId,
        $invoice,
        $loaction,
        $planId = 1657
    ) {
        return $this->post(
            'add',
            [
                'domain-name'       => $domainName,
                'months'            => $months,
                'no-of-accounts'    => $noOfAccounts,
                'customer-id'       => $customerId,
                'invoice-option'    => $invoice,
                'plan-id'           => $planId
            ],
            $loaction
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
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     *
     * @return array
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
        $loaction
    ) {
        return $this->post(
            'admin/add',
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
            ],
            $loaction
        );
    }

    /**
     * @param int $orderId
     * @param int $months
     * @param string $invoice Available options [NoInvoice, PayInvoice, KeepInvoice, OnlyAdd]
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/2712
     */
    public function renew($orderId, $months, $invoice, $loaction)
    {
        return $this->post(
            'renew',
            [
                'order-id'          => $orderId,
                'months'            => $months,
                'invoice-option'    => $invoice,
                'auto-renew'        => false
            ],
            $loaction
        );
    }


    /**
     * @param string $orderId
     * @param int $noOfAccounts
     * @param string $invoice Available options [NoInvoice, PayInvoice, KeepInvoice, OnlyAdd]
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/2714
     */
    public function addAccount($orderId, $noOfAccounts, $invoice, $loaction)
    {
        return $this->post(
            'add-account',
            [
                'order-id'          => $orderId,
                'no-of-accounts'    => $noOfAccounts,
                'invoice-option'    => $invoice
            ],
            $loaction
        );
    }

    /**
     * @param int $orderId
     * @param int $noOfAccounts
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/2715
     */
    public function deleteAccount($orderId, $noOfAccounts, $loaction)
    {
        return $this->post(
            'delete-account',
            [
                'order-id'          => $orderId,
                'no-of-accounts'    => $noOfAccounts
            ],
            $loaction
        );
    }


    /**
     * @param int $orderId
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/2718
     */
    public function delete($orderId, $loaction)
    {
        return $this->post(
            'delete',
            [
                'order-id'          => $orderId
            ],
            $loaction
        );
    }

    /**
     * @param int $orderId
     * @param string $loaction Available options [in = India, se = South East Asia & Egypt, gbl = Global]
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/2719
     */
    public function details($orderId, $loaction)
    {
        return $this->get(
            'details',
            [
                'order-id'          => $orderId
            ],
            $loaction
        );
    }
}
