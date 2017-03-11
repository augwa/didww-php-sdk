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
     * This method will return configuration settings for reseller.
     *
     * @return array
     */
    public function getDetails()
    {
        return $this->api(
            'didww_getdidwwapidetails'
        );
    }

}