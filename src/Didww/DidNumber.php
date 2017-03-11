<?php

namespace Augwa\Didww;

/**
 * Class DidNumber
 * @package Augwa\Didww
 */
class DidNumber
    extends AbstractObject
{

    /**
     * This method will restore canceled and expired DID number within aging period.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[did_number]                  DID Number to be restored
     * @internal int    $data[period]                      Period (months)
     * @internal string $data[uniq_hash]                   Unique md5 hash (Minimum 32 characters length)
     * @internal int    $data[isrenew]                     Auto Renew; 1 - yes, 0 - no
     *
     * @return array
     */
    public function restore(
        array $data = array()
    )
    {
        return $this->api(
            'didww_didrestore',
            $data,
            array(
                'customer_id',
                'did_number'
            )
        );
    }

}