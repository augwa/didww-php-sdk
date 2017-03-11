<?php

namespace Augwa\Didww;

/**
 * Class Sms
 * @package Augwa\Didww
 */
class Sms
    extends AbstractObject
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function getLog(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getsmslog',
            $data,
            array(

            )
        );
    }
}