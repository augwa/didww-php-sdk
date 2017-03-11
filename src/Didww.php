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
     * @param array $data
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
     * @param array $data
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
            $data
        );
    }

    /**
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
     *
     * @return array
     */
    public function getApiDetails(
        array $data = array()
    )
    {
        $api = new Didww\Api(
            $this->getClient(),
            $this->getAuthString()
        );
        return $api->getDetails(
            $data
        );
    }

    /**
     * @param array $data
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
        return $service->getDetails(
            $data
        );
    }

    /**
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
     *
     * @return array
     */
    public function getAutoRenewOrderStatus(
        array $data = array()
    )
    {
        $order = new Didww\Order(
            $this->getClient(),
            $this->getAuthString()
        );
        return $order->getAutoRenewStatus(
            $data
        );
    }

    /**
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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
     * @param array $data
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