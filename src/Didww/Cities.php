<?php

namespace Augwa\Didww;

/**
 * Class Cities
 * @package Augwa\Didww
 */
class Cities
    extends AbstractObject
{

    /**
     * This method will return list of cities from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_id]                     City ID
     * @internal int    $data[active]                      Active; 1 - returns cities with available DID numbers, 0 - all cities will be returned
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getdidwwcities',
            $data,
            array(
                'country_iso'
            )
        );
    }

}