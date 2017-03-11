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
     * This method will return call data records for specified User, DID number, or date period.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[did_number]                  DID Number
     * @internal string $data[from_date]                   Start date from which call records will be retrieved
     * @internal string $data[to_date]                     End date date to which call records will be retrieved
     * @internal string $data[limit]                       Maximum number of call log records to return
     * @internal string $data[offset]                      The offset of the position
     * @internal string $data[order]                       Order records by a specific field
     * @internal string $data[order_Dir]                   Sort rows in ascending or descending order
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