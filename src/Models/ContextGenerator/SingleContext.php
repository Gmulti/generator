<?php

namespace Generator\Models\ContextGenerator;

use Generator\Helpers\Spinning;
use Generator\Models\CanGetSpecificationFactory;
use Generator\Services\UseSpecificationFactory;
use Generator\Models\Generator\CanGenerateText;

class SingleContext implements CanUseText, CanUseDataSpec, CanGenerateText
{
    protected $dataSpecTest = [];

    protected $text = '';

    /**
     * @param CanGetSpecificationFactory $specificationService
     */
    public function __construct(?CanGetSpecificationFactory $specificationService = null)
    {
        if (is_null($specificationService)) {
            $this->createDefaultSpecificationService();
        } else {
            $this->specificationService = $specificationService;
        }
    }

    private function createDefaultSpecificationService()
    {
        $this->specificationService = new UseSpecificationFactory();
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function generate($data): string
    {
        $spec = $this->specificationService->constructSpecification($this->dataSpecTest);

        if (!$spec->isSatisfedBy($data)) {
            return '';
        }

        return $this->getText();
    }

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

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @return int
     */
    public function countWords(): int
    {
        return str_word_count(Spinning::process($this->getText()));
    }
}
