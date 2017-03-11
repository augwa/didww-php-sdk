<?php

namespace Augwa\Didww;

/**
 * Class Regions
 * @package Augwa\DIDWW
 */
class Regions
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
            'didww_getdidwwregions',
            $data
        );
    }

}