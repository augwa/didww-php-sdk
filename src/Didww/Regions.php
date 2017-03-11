<?php

namespace Augwa\Didww;

/**
 * Class Regions
 * @package Augwa\DIDWW
 */
class Regions
    extends AbstractObject
{

    protected $allowed = array(
        'country_iso',
        'city_prefix',
        'last_request_gmt'
    );

    /**
     * @param array $data
     *
     * @return array
     */
    public function getRegions(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getdidwwregions',
            $data
        );
    }

}