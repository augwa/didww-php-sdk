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
     * This method will validate a PSTN Number.
     *
     * @param array $data
     *
     * @internal string $data[pstn_number]                 PSTN number
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