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
     * @param array $data
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
     * @param array $data
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