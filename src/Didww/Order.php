<?php

namespace Augwa\Didww;

/**
 * Class Order
 * @package Augwa\Didww
 */
class Order
    extends AbstractObject
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function create(
        array $data = array()
    )
    {
        return $this->api(
            'didww_ordercreate',
            $data,
            array(
                'customer_id',
                'country_iso',
                'city_prefix',
                'period',
                'map_data',
                'prepaid_funds',
                'uniq_hash',
                'city_id',
            )
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function cancel(
        array $data = array()
    )
    {
        return $this->api(
            'didww_ordercancel',
            $data,
            array(
                'customer_id',
                'did_number'
            )
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function renew(
        array $data = array()
    )
    {
        return $this->api(
            'didww_ordercancel',
            $data,
            array(
                'customer_id',
                'did_number',
                'period',
                'uniq_hash'
            )
        );
    }

    /**
     * @param array $data
     *
     * @return array
     */
    public function getAutoRenewStatus(
        array $data = array()
    )
    {
        return $this->api(
            'didww_order_autorenew_status',
            $data,
            array(
                'customer_id',
                'did_number'
            )
        );
    }

}