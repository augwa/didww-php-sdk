<?php

namespace Augwa\Didww;

/**
 * Class Mapping
 * @package Augwa\Didww
 */
class Mapping
    extends AbstractObject
{

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
            'didww_updatemapping',
            $data,
            array(
                'customer_id',
                'did_number',
                'map_data'
            )
        );
    }

}