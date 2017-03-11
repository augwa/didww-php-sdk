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
     * This method will return list of regions from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_prefix]                 City Prefix
     * @internal string $data[last_request_gmt]            Date in UNIXTIME GMT format. Get list of updated regions starting from date of the last request
     * @internal string $data[city_id]                     City ID
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