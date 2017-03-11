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
     * @param array $data
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getdidwwcities',
            $data
        );
    }

}