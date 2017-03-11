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
     * @return Client
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
     * @return Client
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
     * @return Client
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
                    'connection_timeout' => 5
                )
            );
        }
        return $this->client;
    }

    /**
     * @param \SoapClient $client
     *
     * @return Client
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
     */
    public function getRegions(
        array $data = array()
    )
    {

    }

    public function getPstnRates(
        array $data = array()
    )
    {

    }

    public function updatePstnRates(
        array $data = array()
    )
    {

    }

    public function checkPstnNumber(
        array $data = array()
    )
    {

    }

    public function orderCreate(
        array $data = array()
    )
    {

    }

    public function orderCancel(
        array $data = array()
    )
    {

    }

    public function orderAutoRenew(
        array $data = array()
    )
    {

    }

    public function updateMapping(
        array $data = array()
    )
    {

    }

    public function getPrepaidBalance(
        array $data = array()
    )
    {

    }

    public function updatePrepaidBalance(
        array $data = array()
    )
    {

    }

    public function restoreDidNumber(
        array $data = array()
    )
    {

    }

    public function getApiDetails(
        array $data = array()
    )
    {

    }

    public function getServiceDetails(
        array $data = array()
    )
    {

    }

    public function getCdrLog(
        array $data = array()
    )
    {

    }

    public function getCallHistoryInvoices(
        array $data = array()
    )
    {

    }

    public function getPrepaidBalanceList(
        array $data = array()
    )
    {

    }

    public function getAutoRenewOrderStatus(
        array $data = array()
    )
    {

    }

    public function getPstnTraffic(
        array $data = array()
    )
    {

    }

    public function getCountries(
        array $data = array()
    )
    {

    }

    public function getCities(
        array $data = array()
    )
    {

    }

    public function getServiceList(
        array $data = array()
    )
    {

    }

}