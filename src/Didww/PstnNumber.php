<?php

namespace Augwa\Didww;

/**
 * Class PstnNumber
 * @package Augwa\Didww
 */
class PstnNumber
    extends AbstractObject
{

    /**
     * @param array $data
     *
     * @return array
     */
    public function check(
        array $data = array()
    )
    {
        return $this->api(
            'didww_checkpstnnumber',
            $data,
            array(
                'pstn_number'
            )
        );
    }

}