<?php

namespace Generator\Models\ContextGenerator;

use Generator\Helpers\Spinning;
use Generator\Models\CanGetSpecificationFactory;
use Generator\Services\UseSpecificationFactory;
use Generator\Models\Generator\CanGenerateText;
use Generator\Models\Compose\Probability;
use Generator\Models\Compose\Text;
use Generator\Models\Compose\DataSpec;

class SingleContext implements CanUseText, CanUseDataSpec, CanGenerateText, CanUseProbability
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
