<?php

namespace Augwa\Didww;

/**
 * Class PstnTraffic
 * @package Augwa\Didww
 */
class PstnTraffic
    extends AbstractObject
{

    /**
     * This method will return data for building PSTN Traffic chart, including "Cost", "Sold" and "Duration" values.
     *
     * @param array $data
     *
     * @internal string $data[from_date]                   Start date from which PSTN traffic records will be retrieved
     * @internal string $data[to_date]                     End date date to which PSTN traffic records will be retrieved
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_pstn_traffic',
            $data
        );
    }

}