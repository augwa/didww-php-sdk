<?php

namespace Augwa\Didww;

/**
 * Class Mapping
 * @package Augwa\Didww
 */
class Mapping
    extends AbstractObject
{

    /**
     * This method will change/update forwarding data for DID Number.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]
     * @internal string $data[did_number]
     * @internal string $data[map_data][map_type]          Map Type; URI or ITSP
     * @internal string $data[map_data][map_proto]         Map Proto; SIP, H323 or IAX2
     * @internal string $data[map_data][map_detail]        Map Detail; ip address, hostname, etc
     * @internal int    $data[map_data][map_pref_server]   Map Pref Server; 0 – Local Server (automatic detection), 1 – USA Server, 3 – Europe Server
     * @internal string $data[map_data][map_itsp_id]       Map ITSP ID; Provider ID
     * @internal string $data[map_data][cli_format]        CLI Format; RAW - Do not alter CLI (default); E164 - Attempt to convert CLI to E.164 format; Local - Attempt to convert CLI to localized format
     * @internal string $data[map_data][cli_prefix]        CLI Prefix; Can be prefixed with optional '+' sign followed by up to 6 characters including digits and '#'
     *
     * @return array
     */
    public function update(
        array $data = array()
    )
    {
        return $this->api(
            'didww_updatemapping',
            $data,
            array(
                'customer_id',
                'did_number',
                'map_data'
            )
        );
    }

}