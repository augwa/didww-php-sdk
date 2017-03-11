<?php

namespace Augwa\Didww;

/**
 * Class PrepaidBalance
 * @package Augwa\Didww
 */
class PrepaidBalance
    extends AbstractObject
{

    /**
     * This method will return current Prepaid Balance of customer.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getprepaidbalance',
            $data,
            array(
                'customer_id'
            )
        );
    }

    /**
     * This method will update customer's Prepaid Balance. Add/Remove points.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[prepaid_funds]               Amount in points
     * @internal int    $data[operation_type]              Operation Type; 1 - Add funds (positive amount), 2 - Remove funds (negative amount)
     * @internal string $data[uniq_hash]                   Unique md5 hash (Minimum 32 characters length)
     *
     * @return array
     */
    public function update(
        array $data = array()
    )
    {
        return $this->api(
            'didww_updateprepaidbalance',
            $data,
            array(
                'customer_id',
                'prepaid_funds',
                'operation_type',
                'uniq_hash'
            )
        );
    }

    /**
     * This method will return array of balances of all customers.
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
            'didww_getprepaidbalancelist',
            $data
        );
    }

}