<?php

namespace Augwa\Didww;

/**
 * Class PstnTraffic
 * @package Augwa\Didww
 */
class PstnTraffic
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
            'didww_pstn_traffic',
            $data,
            array(
                'from_date',
                'to_date'
            )
        );
    }

}