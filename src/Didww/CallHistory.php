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
     * @param array $data
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