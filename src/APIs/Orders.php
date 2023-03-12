<?php

namespace RT\ResellerClub\APIs;

use RT\ResellerClub\Helper;

/**
 * Class Orders
 *
 * @package RT\ResellerClub\APIs
 */
class Orders
{
    use Helper;

    /**
     * @var string
     */
    protected $api = 'orders';

    /**
     * @param int    $orderId
     * @param string $reason
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/1077
     */
    public function suspend($orderId, $reason)
    {
        return $this->post(
            'suspend',
            [
                'order-id' => $orderId,
                'reason'   => $reason,
            ]
        );
    }

    /**
     * @param int    $orderId
     * @param string $reason
     *
     * @return array
     * @link https://manage.logicboxes.com/kb/answer/1078
     * @todo "reason" parameter does not exist in the documents.
     */
    public function unsuspend($orderId, $reason)
    {
        return $this->post(
            'unsuspend',
            [
                'order-id' => $orderId,
                'reason'   => $reason,
            ]
        );
    }
}
