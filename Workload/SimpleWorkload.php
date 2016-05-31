<?php

namespace Horrible\GearmanBundle\Workload;

/**
 * Class SimpleWorkload
 * @package Horrible\GearmanBundle\Workload
 */
class SimpleWorkload implements WorkloadInterface
{
    /**
     * @var string
     */
    protected $encodedData;

    /**
     * @var mixed
     */
    protected $decodedData;

    /**
     * @param mixed $data
     */
    public function setEncodedData($data)
    {
        $this->encodedData = $data;
        $this->decode();
    }

    /**
     * @param mixed $data
     */
    public function setDecodedData($data)
    {
        $this->decodedData = $data;
        $this->encode();
    }

    /**
     * {@inheritDoc}
     */
    public function getDecodedData()
    {
        return $this->decodedData;
    }

    /**
     * {@inheritDoc}
     */
    public function getEncodedData()
    {
        return $this->encodedData;
    }

    protected function decode()
    {
        try {
            $this->decodedData = json_decode($this->encodedData, true);
        } catch (\Exception $exception) {
            $this->decodedData = [];
        }
    }

    protected function encode()
    {
        $this->encodedData = json_encode($this->decodedData);
    }
}
