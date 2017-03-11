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
     * This method will return sms data records
     *
     * @param array $data
     *
     * @internal int    $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[from_date]                   Start date from which records will be retrieved
     * @internal string $data[to_date]                     End date date to which records will be retrieved
     * @internal string $data[destination]                 Destination number
     * @internal string $data[source]                      Source number
     * @internal int    $data[success]                     Success; 1 - true, 0 - false
     * @internal int    $data[limit]                       Maximum number of sms log records to return
     * @internal int    $data[offset]                      The offset of the position
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
            'didww_getsmslog',
            $data
        );
    }
}