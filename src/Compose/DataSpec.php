<?php

namespace Generator\Compose;

trait DataSpec
{
    protected $dataSpecTest = [];

    /**
     * @return array
     */
    public function getDataSpecTest(): array
    {
        return $this->dataSpecTest;
    }

    /**
     * @param array $dataSpecTest
     */
    public function setDataSpecTest(array $dataSpecTest)
    {
        $this->dataSpecTest = $dataSpecTest;

        return $this;
    }
}
