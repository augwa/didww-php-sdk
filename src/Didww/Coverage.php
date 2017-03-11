<?php

namespace Augwa\Didww;

/**
 * Class Coverage
 * @package Augwa\Didww
 */
class Coverage
    extends AbstractObject
{

    /**
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_prefix]                 City Area Prefix
     * @internal int    $data[city_id]                     City ID
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getcoverage',
            $data
        );
    }

}