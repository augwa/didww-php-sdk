<?php

namespace Augwa\Didww;

/**
 * Class Countries
 * @package Augwa\Didww
 */
class Countries
    extends AbstractObject
{

    /**
     * This method will return list of available countries from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getdidwwcountries',
            $data
        );
    }

}