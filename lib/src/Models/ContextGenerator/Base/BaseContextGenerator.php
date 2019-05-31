<?php

namespace Generator\Models\ContextGenerator\Base;

use Generator\Helpers\Spinning;
use Generator\Models\SpecificationServiceInterface;
use Generator\Services\Specification;

class BaseContextGenerator implements TextGeneratorInterface, ContextGeneratorInterface
{
    protected $dataSpecTest = [];

    protected $text = '';

    /**
     * @param SpecificationServiceInterface $specificationService
     */
    public function __construct(SpecificationServiceInterface $specificationService = null)
    {
        if (is_null($specificationService)) {
            $this->createDefaultSpecificationService();
        }
    }

    private function createDefaultSpecificationService()
    {
        $this->specificationService = new Specification();
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

    public function countWords()
    {
        return str_word_count(Spinning::process($this->getText()));
    }
}
