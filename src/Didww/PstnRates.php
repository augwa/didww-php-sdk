<?php

namespace Augwa\Didww;

/**
 * Class PstnRates
 * @package Augwa\Didww
 */
class PstnRates
    extends AbstractObject
{

    /**
     * This method will return list of supported PSTN prefixes from DIDWW.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[pstn_prefix]                 PSTN Prefix
     * @internal string $data[last_request_gmt]            Date in UNIXTIME GMT format. Get list of updated PSTN Rates starting from date of the last request
     *
     * @return array
     */
    public function get(
        array $data = array()
    )
    {
        return $this->api(
            'didww_getdidwwpstnrates',
            $data
        );
    }

    /**
     * This method will change PSTN tariffs for resellers through their Staff panel.
     *
     * @param array $data
     *
     * @internal string $data[][network_prefix]            Network Prefix
     * @internal string $data[][sell_rate]                 Sell Rate
     *
     * @return array
     */
    public function update(
        array $data = array()
    )
    {
        return $this->api(
            'didww_updatepstnrates',
            $data,
            array(
                'rates'
            )
        );
    }

}