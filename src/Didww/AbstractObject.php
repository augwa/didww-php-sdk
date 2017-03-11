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

    /** @var array */
    protected $required = array();

    /** @var array */
    protected $allowed = array();

    /**
     * @return \SoapClient
     */
    protected function getClient()
    {
        return $this->client;
    }

    /**
     * @param \SoapClient $client
     *
     * @return AbstractObject
     */
    protected function setClient(
        $client
    )
    {
        $this->client = $client;
        return $this;
    }

    /**
     * @return string
     */
    protected function getAuthString()
    {
        return $this->authString;
    }

    /**
     * @param string $authString
     *
     * @return AbstractObject
     */
    protected function setAuthString(
        $authString
    )
    {
        $this->authString = $authString;
        return $this;
    }

    /**
     * @return array
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @return array
     */
    public function getAllowed()
    {
        return $this->allowed;
    }

    /**
     * AbstractObject constructor.
     *
     * @param \SoapClient $client
     */
    public function __construct(
        \SoapClient $client
    )
    {
        $this->setClient($client);
    }

    /**
     * @param $method
     * @param array $data
     *
     * @return array
     * @throws Exception\RequiredFieldException
     */
    protected function api(
        $method,
        array $data = array()
    )
    {
        $diff = array_diff_key(array_flip($this->required), $data);
        if (sizeof($diff) > 0) {
            throw new Exception\RequiredFieldException(
                sprintf(
                    'Required data missing: %s',
                    implode(', ', $diff)
                )
            );
        }

        $diff = array_diff_key(
            $data,
            array_flip(
                array_merge(
                    $this->allowed,
                    $this->required
                )
            )
        );

        if (sizeof($diff)) {
            trigger_error(
                sprintf(
                    'Discarded unknown keys: %s',
                    implode(', ', $diff)
                ),
                E_USER_NOTICE
            );
        }

        $data = array_merge(
            array_intersect_key(array_flip($this->required), $data),
            array(
                'auth_string' => $this->authString
            )
        );

        $responseNode = sprintf('%sResult', $method);
        $xmlResponse = $this->getClient()->$method($data)->$responseNode;
        $arr = array();

        return $this->array_flat(
            json_decode(
                json_encode(
                    (array) simplexml_load_string($xmlResponse)
                ),
                true
            ),
            $arr
        );
    }

    /**
     * @param array $complexArray
     * @param array $flatArray
     *
     * @return array
     */
    private function array_flat(
        array $complexArray,
        array &$flatArray
    )
    {
        foreach ($complexArray as $key => $value) {
            if (is_array($value)) {
                $flatArray = array_merge($flatArray, $this->array_flat($value, $flatArray));
            } else {
                $flatArray[$key] = trim($value);
            }
        }

        return $flatArray;
    }
}