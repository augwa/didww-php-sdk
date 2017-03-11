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
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getcoverage',
            $data,
            array(

            )
        );
    }

}