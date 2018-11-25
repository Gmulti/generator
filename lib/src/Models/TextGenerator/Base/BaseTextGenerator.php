<?php

namespace Generator\Models\TextGenerator\Base;

use Generator\Helpers\Spinning;

class BaseTextGenerator
{
    protected $dataSpecTest = [];

    protected $text = "";

    public function __construct()
    {
        $this->specificationService = generator_get_service('Specification');
    }

    /**
     *
     * @param array $data
     * @return string
     */
    public function generate($data) : string
    {
        $spec = $this->specificationService->constructSpecification($this->dataSpecTest);

        if (!$spec->isSatisfedBy($data)) {
            return '';
        }

        return $this->getText();
    }

    /**
     *
     * @return array
     */
    public function getDataSpecTest() : array
    {
        return $this->dataSpecTest;
    }

    /**
     *
     * @param array $dataSpecTest
     * @return void
     */
    public function setDataSpecTest(array $dataSpecTest)
    {
        $this->dataSpecTest = $dataSpecTest;
        return $this;
    }

    /**
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     *
     * @return string
     */
    public function getText() : string
    {
        return $this->text;
    }

    public function countWords()
    {
        return str_word_count(Spinning::process($this->getText()));
    }
}
