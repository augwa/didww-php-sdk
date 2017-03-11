<?php

namespace Augwa\Didww;

/**
 * Class Order
 * @package Augwa\Didww
 */
class Order
    extends AbstractObject
{

    /**
     * This method will purchase new service.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_prefix]                 City Prefix
     * @internal int    $data[period]                      Period (months)
     * @internal string $data[map_data][map_type]          Map Type; URI or ITSP
     * @internal string $data[map_data][map_proto]         Map Proto; SIP, H323 or IAX2
     * @internal string $data[map_data][map_detail]        Map Detail; ip address, hostname, etc
     * @internal int    $data[map_data][map_pref_server]   Map Pref Server; 0 – Local Server (automatic detection), 1 – USA Server, 3 – Europe Server
     * @internal string $data[map_data][map_itsp_id]       Map ITSP ID; Provider ID
     * @internal string $data[map_data][cli_format]        CLI Format; RAW - Do not alter CLI (default); E164 - Attempt to convert CLI to E.164 format; Local - Attempt to convert CLI to localized format
     * @internal string $data[map_data][cli_prefix]        CLI Prefix; Can be prefixed with optional '+' sign followed by up to 6 characters including digits and '#'
     * @internal string $data[prepaid_funds]               Amount in points
     * @internal string $data[uniq_hash]                   Unique md5 hash (Minimum 32 characters length). If unique hash has already been processed, method returns the information about DID number that was previously created with the same unique hash.
     * @internal string $data[city_id]                     City ID
     * @internal int    $data[autorenew_enable]            Enable automatic renewal; 1 - true; 0 - false
     *
     * @return array
     */
    public function create(
        array $data = array()
    )
    {
        return $this->api(
            'didww_ordercreate',
            $data,
            array(
                'customer_id',
                'country_iso',
                'period',
                'uniq_hash',
            )
        );
    }

    /**
     * This method will cancel order and remove purchased services.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[did_number]                  DID number to cancel
     *
     * @return array
     */
    public function cancel(
        array $data = array()
    )
    {
        return $this->api(
            'didww_ordercancel',
            $data,
            array(
                'customer_id',
                'did_number'
            )
        );
    }

    /**
     * This method will renew active service for specific period.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[did_number]                  DID Number to renew
     * @internal int    $data[period]                      Month(s) to renew for
     * @internal string $data[uniq_hash]                   Unique md5 hash (minimum 32 characters length)
     *
     * @return array
     */
    public function renew(
        array $data = array()
    )
    {
        return $this->api(
            'didww_orderautorenew',
            $data,
            array(
                'customer_id',
                'did_number',
                'period',
                'uniq_hash'
            )
        );
    }

    /**
     * This method will change Auto-renew status of the specified DID number.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[did_number]                  DID Number to renew
     * @internal int    $data[status]                      Order status; Completed, Pending or Canceled
     *
     * @return array
     */
    public function toggleAutoRenew(
        array $data = array()
    )
    {
        return $this->api(
            'didww_order_autorenew_status',
            $data,
            array(
                'customer_id',
                'did_number'
            )
        );
    }

}