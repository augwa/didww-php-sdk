<?php

namespace Augwa\Didww;

/**
 * Class CallHistory
 * @package Augwa\Didww
 */
class CallHistory
    extends AbstractObject
{

    /**
     * This method will return data for invoice generation based on CDR.
     *
     * @param array $data
     *
     * @internal int    $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[from_date]                   Start date from which call records will be retrieved
     * @internal string $data[to_date]                     End date date to which call records will be retrieved
     *
     * @return array
     */
    public function getInvoices(
        array $data = array()
    )
    {
        return $this->api(
            'didww_callhistory_invoices',
            $data
        );
    }

}