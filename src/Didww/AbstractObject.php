<?php

namespace Augwa\Didww;

/**
 * Class AbstractObject
 * @package Augwa\DIDWW
 */
class AbstractObject
{

    /** @var \SoapClient */
    protected $client;

    /** @var string */
    private $authString;

    /**
     * @return \SoapClient
     */
    private function getClient()
    {
        return $this->client;
    }

    /**
     * @param \SoapClient $client
     *
     * @return AbstractObject
     */
    private function setClient(
        $client
    )
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    private function getAuthString()
    {
        return $this->authString;
    }

    /**
     * @param string $authString
     *
     * @return AbstractObject
     */
    private function setAuthString(
        $authString
    )
    {
        $this->authString = $authString;
        return $this;
    }

    /**
     * AbstractObject constructor.
     *
     * @param \SoapClient $client
     * @param string $authString
     */
    public function __construct(
        \SoapClient $client,
        $authString
    )
    {
        $this->setClient($client);
        $this->setAuthString($authString);
    }

    /**
     * @param $method
     * @param array $data
     * @param array $required
     *
     * @return array
     * @throws Exception\RequiredFieldException
     */
    protected function api(
        $method,
        array $data = array(),
        array $required = array()
    )
    {
        $diff = array_diff_key(array_flip($required), $data);
        if (sizeof($diff) > 0) {
            throw new Exception\RequiredFieldException(
                sprintf(
                    'Required data missing: %s',
                    implode(', ', array_keys($diff))
               )
            );
        }

        $data = array_merge(
            $data,
            array(
                'auth_string' => $this->getAuthString(),
            )
        );

        $response = $this->getClient()->__soapCall(
            $method,
            $this->reOrderData($method, $data)
        );

        return $response;
    }

    /**
     * @param string $method
     * @param array $data
     *
     * @return array
     * @throws Exception\SaveFileException
     */
    private function reOrderData(
        $method,
        array $data
    )
    {
        $requestXsd = __DIR__ . '/../../resources/didww.xsd';
        $this->cacheWsdl($requestXsd);

        $xml = new \DOMDocument();
        $xml->load($requestXsd);
        $xpath = new \DOMXPath($xml);

        $elements = array();

        $result = $xpath->query(sprintf('/wsdl:definitions/wsdl:message[@name="%sRequest"]/wsdl:part', $method));
        /** @var $node \DOMElement  */
        foreach($result as $node) {
            $elements[] = $node->getAttribute('name');
        }

        $newData = array();

        foreach($elements as $element) {
            if (array_key_exists($element, $data)) {
                $newData[$element] = $data[$element];
            } else {
                $newData[$element] = null;
            }
        }

        return $newData;
    }

    /**
     * @param $fileName
     *
     * @throws Exception\SaveFileException
     */
    private function cacheWsdl(
        $fileName
    )
    {
        if (false === file_exists($fileName)) {
            if (false === file_put_contents(
                    $fileName,
                    file_get_contents('http://api.didww.com/api2/?wsdl')
                )
            ) {
                throw new Exception\SaveFileException(
                    'Unable to download and save didww wsdl'
                );
            }
        }
    }

}