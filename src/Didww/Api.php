<?php

namespace Augwa\Didww;

/**
 * Class Api
 * @package Augwa\Didww
 */
class Api
    extends AbstractObject
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function getDetails(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getdidwwapidetails',
            $data
        );
    }

}