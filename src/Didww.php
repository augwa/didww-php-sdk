<?php

namespace Augwa;

class Didww
{

    /** @var string */
    private $apiUsername;

    /** @var string */
    private $apiKey;

    /** @var bool */
    private $testMode = false;

    /** @var \SoapClient */
    private $client;

    /** @var int */
    private $connectionTimeout = 5;

    /**
     * @return string
     */
    public function getApiUsername()
    {
        return $this->apiUsername;
    }

    /**
     * @param string $apiUsername
     *
     * @return Didww
     */
    public function setApiUsername(
        $apiUsername
    )
    {
        $this->apiUsername = (string)$apiUsername;
        return $this;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     *
     * @return Didww
     */
    public function setApiKey(
        $apiKey
    )
    {
        $this->apiKey = (string)$apiKey;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTestMode()
    {
        return $this->testMode;
    }

    /**
     * @param bool $testMode
     *
     * @return Didww
     */
    public function setTestMode(
        $testMode
    )
    {
        $this->testMode = (bool)$testMode;
        $this->setClient();
        return $this;
    }

    /**
     * @return int
     */
    public function getConnectionTimeout()
    {
        return $this->connectionTimeout;
    }

    /**
     * @param int $connectionTimeout
     *
     * @return Didww
     */
    public function setConnectionTimeout(
        $connectionTimeout
    )
    {
        $this->connectionTimeout = (int)max(0,$connectionTimeout);
        $this->setClient();
        return $this;
    }

    /**
     * @return string
     */
    protected function getAuthString()
    {
        return sha1(
            sprintf(
                '%s%s%s',
                $this->getApiUsername(),
                $this->getApiKey(),
                $this->isTestMode() ? 'sandbox' : ''
            )
        );
    }

    /**
     * @return \SoapClient
     */
    protected function getClient()
    {
        if (null === $this->client) {
            $endpoint = 'http://api.didww.com/api2/?wsdl';
            if ($this->isTestMode()) {
                $endpoint = 'https://sandbox-api.didww.com/api2/index.php?wsdl';
            }
            $this->client = new \SoapClient(
                $endpoint,
                array(
                    'connection_timeout' => $this->getConnectionTimeout(),
                    'soap_version' => \SOAP_1_1
                )
            );
        }
        return $this->client;
    }

    /**
     * @param \SoapClient $client
     *
     * @return Didww
     */
    protected function setClient(
        \SoapClient $client = null
    )
    {
        $this->client = $client;
        return $this;
    }

    /**
     * Client constructor.
     *
     * @param string $apiUsername
     * @param string $apiKey
     * @param bool $testMode
     */
    public function __construct(
        $apiUsername = null,
        $apiKey = null,
        $testMode = false
    )
    {
        $this->setApiUsername($apiUsername);
        $this->setApiKey($apiKey);
        $this->setTestMode($testMode);
    }

    /**
     * This method will return list of regions from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_prefix]                 City Prefix
     * @internal string $data[last_request_gmt]            Date in UNIXTIME GMT format. Get list of updated regions starting from date of the last request
     * @internal string $data[city_id]                     City ID
     *
     * @return array
     */
    public function getRegions(
        array $data = array()
    )
    {
        $regions = new Didww\Regions(
            $this->getClient(),
            $this->getAuthString()
        );
        return $regions->get(
            $data
        );
    }

    /**
     * This method will return list of regions from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_prefix]                 City Prefix
     * @internal string $data[last_request_gmt]            Date in UNIXTIME GMT format. Get list of updated regions starting from date of the last request
     * @internal string $data[city_id]                     City ID
     *
     * @return array
     */
    public function getPstnRates(
        array $data = array()
    )
    {
        $pstnRates = new Didww\PstnRates(
            $this->getClient(),
            $this->getAuthString()
        );
        return $pstnRates->get(
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
    public function updatePstnRates(
        array $data = array()
    )
    {
        $pstnRates = new Didww\PstnRates(
            $this->getClient(),
            $this->getAuthString()
        );
        return $pstnRates->update(
            array(
                'rates' => $data
            )
        );
    }

    /**
     * This method will validate a PSTN Number.
     *
     * @param array $data
     *
     * @internal string $data[pstn_number]                 PSTN number
     *
     * @return array
     */
    public function checkPstnNumber(
        array $data = array()
    )
    {
        $pstnNumber = new Didww\PstnNumber(
            $this->getClient(),
            $this->getAuthString()
        );
        return $pstnNumber->check(
            $data
        );
    }

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
    public function orderCreate(
        array $data = array()
    )
    {
        $order = new Didww\Order(
            $this->getClient(),
            $this->getAuthString()
        );
        return $order->create(
            $data
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
    public function orderCancel(
        array $data = array()
    )
    {
        $order = new Didww\Order(
            $this->getClient(),
            $this->getAuthString()
        );
        return $order->cancel(
            $data
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
    public function orderRenew(
        array $data = array()
    )
    {
        $order = new Didww\Order(
            $this->getClient(),
            $this->getAuthString()
        );
        return $order->renew(
            $data
        );
    }

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
    public function updateMapping(
        array $data = array()
    )
    {
        $mapping = new Didww\Mapping(
            $this->getClient(),
            $this->getAuthString()
        );
        return $mapping->update(
            $data
        );
    }

    /**
     * This method will return current Prepaid Balance of customer.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     *
     * @return array
     */
    public function getPrepaidBalance(
        array $data = array()
    )
    {
        $prepaidBalance = new Didww\PrepaidBalance(
            $this->getClient(),
            $this->getAuthString()
        );
        return $prepaidBalance->get(
            $data
        );
    }

    /**
     * This method will update customer's Prepaid Balance. Add/Remove points.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[prepaid_funds]               Amount in points
     * @internal int    $data[operation_type]              Operation Type; 1 - Add funds (positive amount), 2 - Remove funds (negative amount)
     * @internal string $data[uniq_hash]                   Unique md5 hash (Minimum 32 characters length)
     *
     * @return array
     */
    public function updatePrepaidBalance(
        array $data = array()
    )
    {
        $prepaidBalance = new Didww\PrepaidBalance(
            $this->getClient(),
            $this->getAuthString()
        );
        return $prepaidBalance->update(
            $data
        );
    }

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
    public function restoreDidNumber(
        array $data = array()
    )
    {
        $didNumber = new Didww\DidNumber(
            $this->getClient(),
            $this->getAuthString()
        );
        return $didNumber->restore(
            $data
        );
    }

    /**
     * This method will return configuration settings for reseller.
     *
     * @return array
     */
    public function getApiDetails()
    {
        $api = new Didww\Api(
            $this->getClient(),
            $this->getAuthString()
        );
        return $api->getDetails();
    }

    /**
     * This method will return order details on the API for the component synchronization.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     * @internal string $data[api_order_id]                Order ID on API
     * @internal string $data[did_number]                  DID Number
     *
     * $data[api_order_id] and $data[did_number] parameters are interchangeable, so query can be done by api_order_id OR did_number
     *
     * @return array
     */
    public function getServiceDetails(
        array $data = array()
    )
    {
        $service = new Didww\Service(
            $this->getClient(),
            $this->getAuthString()
        );

        if (
            array_key_exists('api_order_id', $data) &&
            false === array_key_exists('did_number', $data)
        ) {
            $data['did_number'] = null;
        }

        if (
            array_key_exists('did_number', $data) &&
            false === array_key_exists('api_order_id', $data)
        ) {
            $data['api_order_id'] = null;
        }

        return $service->getDetails(
            $data
        );
    }

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
    public function getCdrLog(
        array $data = array()
    )
    {
        $cdr = new Didww\Cdr(
            $this->getClient(),
            $this->getAuthString()
        );
        return $cdr->getLog(
            $data
        );
    }

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
    public function getCallHistoryInvoices(
        array $data = array()
    )
    {
        $callHistory = new Didww\CallHistory(
            $this->getClient(),
            $this->getAuthString()
        );
        return $callHistory->getInvoices(
            $data
        );
    }

    /**
     * This method will return array of balances of all customers.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     *
     * @return array
     */
    public function getPrepaidBalanceList(
        array $data = array()
    )
    {
        $prepaidBalance = new Didww\PrepaidBalance(
            $this->getClient(),
            $this->getAuthString()
        );
        return $prepaidBalance->getList(
            $data
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
    public function orderToggleAutoRenew(
        array $data = array()
    )
    {
        $order = new Didww\Order(
            $this->getClient(),
            $this->getAuthString()
        );
        return $order->toggleAutoRenew(
            $data
        );
    }

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
    public function getPstnTraffic(
        array $data = array()
    )
    {
        $pstnTaffic = new Didww\PstnTraffic(
            $this->getClient(),
            $this->getAuthString()
        );
        return $pstnTaffic->get(
            $data
        );
    }

    /**
     * This method will return list of available countries from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     *
     * @return array
     */
    public function getCountries(
        array $data = array()
    )
    {
        $countries = new Didww\Countries(
            $this->getClient(),
            $this->getAuthString()
        );
        return $countries->get(
            $data
        );
    }

    /**
     * This method will return list of cities from DIDWW coverage list.
     *
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_id]                     City ID
     * @internal int    $data[active]                      Active; 1 - returns cities with available DID numbers, 0 - all cities will be returned
     *
     * @return array
     */
    public function getCities(
        array $data = array()
    )
    {
        $cities = new Didww\Cities(
            $this->getClient(),
            $this->getAuthString()
        );
        return $cities->get(
            $data
        );
    }

    /**
     * This method will return list of orders for given customer.
     *
     * @param array $data
     *
     * @internal string $data[customer_id]                 Customer ID (from your local database, any digit)
     *
     * @return array
     */
    public function getServiceList(
        array $data = array()
    )
    {
        $service = new Didww\Service(
            $this->getClient(),
            $this->getAuthString()
        );
        return $service->getList(
            $data
        );
    }

    /**
     * @param array $data
     *
     * @internal string $data[country_iso]                 Country ISO Code
     * @internal string $data[city_prefix]                 City Area Prefix
     * @internal int    $data[city_id]                     City ID
     *
     * @return array
     */
    public function getCoverage(
        array $data = array()
    )
    {
        $coverage = new Didww\Coverage(
            $this->getClient(),
            $this->getAuthString()
        );
        return $coverage->get(
            $data
        );
    }

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
    public function getSmsLog(
        array $data = array()
    )
    {
        $sms = new Didww\Sms(
            $this->getClient(),
            $this->getAuthString()
        );
        return $sms->getLog(
            $data
        );
    }

}