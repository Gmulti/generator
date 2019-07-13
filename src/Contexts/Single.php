<?php

namespace Generator\Contexts;

use Generator\Helpers\Spinning;
use Generator\Models\CanGetSpecificationFactory;
use Generator\Models\CanGenerateText;
use Generator\Services\UseSpecificationFactory;
use Generator\Compose\CanUseText;
use Generator\Compose\CanUseDataSpec;
use Generator\Compose\CanUseProbability;
use Generator\Compose\Probability;
use Generator\Compose\Text;
use Generator\Compose\DataSpec;

class Single implements CanUseText, CanUseDataSpec, CanGenerateText, CanUseProbability
{
    use Probability;
    use Text;
    use DataSpec;

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

        if (!$spec->isSatisfedBy($data) || !$this->isPossible()) {
            return '';
        }

        return $this->getText();
    }

    /**
     * @return int
     */
    public function countWords(): int
    {
        return str_word_count(Spinning::process($this->getText()));
    }
}
