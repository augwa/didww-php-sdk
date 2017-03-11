<?php

namespace Augwa\Didww;

/**
 * Class DidNumber
 * @package Augwa\Didww
 */
class DidNumber
    extends AbstractObject
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function restore(
        array $data = array()
    )
    {
        return $this->api(
            'didww_didrestore',
            $data,
            array(
                'customer_id',
                'did_number',
                'period',
                'uniq_hash'
            )
        );
    }

}