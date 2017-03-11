<?php

namespace Augwa\Didww;

/**
 * Class PstnRates
 * @package Augwa\Didww
 */
class PstnRates
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
            'didww_getdidwwpstnrates',
            $data
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
            'didww_updatepstnrates',
            $data,
            array(
                'rates'
            )
        );
    }

}