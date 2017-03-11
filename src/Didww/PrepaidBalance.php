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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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