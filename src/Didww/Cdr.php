<?php

namespace Augwa\Didww;

/**
 * Class Cdr
 * @package Augwa\Didww
 */
class Cdr
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
            'didww_getcdrlog',
            $data
        );
    }

}