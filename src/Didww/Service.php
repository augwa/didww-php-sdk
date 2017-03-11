<?php

namespace Augwa\Didww;

/**
 * Class Service
 * @package Augwa\Didww
 */
class Service
    extends AbstractObject
{

    /**
     * This method will return order details on the API for the component synchronization.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[api_order_id]                Order ID on API
     * @internal string $data[did_number]                  DID Number
     *
     * $data[api_order_id] and $data[did_number] parameters are interchangeable, so query can be done by api_order_id OR did_number
     *
     * @return array
     */
    public function getDetails(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getservicedetails',
            $data,
            array(
                'customer_id',
                'api_order_id',
                'did_number'
            )
        );
    }

    /**
     * This method will return list of orders for given customer.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     *
     * @return array
     */
    public function getList(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getservicelist',
            $data,
            array(
                'customer_id'
            )
        );
    }

}