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
     * @param array $data
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