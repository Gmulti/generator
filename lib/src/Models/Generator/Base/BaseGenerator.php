<?php

namespace Generator\Models\Generator\Base;

use Generator\Helpers\Spinning;
use Generator\Factory\ManyContextGeneratorFactory;
use Generator\Factory\TextGeneratorFactory;
use Generator\Models\ContextGenerator\Base\ManyContextGeneratorInterface;
use Generator\Models\ContextGenerator\Base\TextGeneratorInterface;
use Generator\Models\VariableToStringServiceInterface;
use Generator\Services\VariableToString;

class BaseGenerator implements GeneratorInterface
{
    protected $textGenerators;

    public function __construct(array $textGenerators = [], $factories = [], VariableToStringServiceInterface $variableToString = null)
    {
        $this->setTextGenerators($textGenerators);

        if (!array_key_exists('ManyContextGenerator', $factories)) {
            $this->setDefaultManyContextGeneratorFactory();
        } else {
            $this->manyContextGeneratorFactory = $factories['ManyContextGenerator'];
        }

        if (!array_key_exists('TextGenerator', $factories)) {
            $this->setDefaultTextGeneratorFactory();
        } else {
            $this->textGeneratorFactory = $factories['TextGenerator'];
        }

        if (is_null($variableToString)) {
            $this->createVariableToStringService();
        }
    }

    public function createVariableToStringService()
    {
        $this->variableToStringService = new VariableToString();
    }

    public function setDefaultTextGeneratorFactory()
    {
        $this->textGeneratorFactory = new TextGeneratorFactory();
    }

    public function setDefaultManyContextGeneratorFactory()
    {
        $this->manyContextGeneratorFactory = new ManyContextGeneratorFactory();
    }

    /**
     * @param array $textGenerators
     */
    public function setTextGenerators(array $textGenerators)
    {
        $this->textGenerators = $textGenerators;

        return $this;
    }

    /**
     * @return array
     */
    public function getTextGenerators(): array
    {
        return $this->textGenerators;
    }

    protected function getSetupTextGenerators()
    {
        foreach ($this->getTextGenerators() as $key => $contextGenerator) {
            if (!array_key_exists('class', $contextGenerator)) {
                continue;
            }

            if (array_key_exists('class', $contextGenerator) && is_string($contextGenerator['class'])) {
                $contextGenerator['class'] = new $contextGenerator['class']();
            }

            if ($contextGenerator['class'] instanceof ManyContextGeneratorInterface) {
                $contextGenerator = $this->manyContextGeneratorFactory->constructManyContextGenerator($contextGenerator);
            } elseif ($contextGenerator['class'] instanceof TextGeneratorInterface) {
                $contextGenerator = $this->textGeneratorFactory->constructTextGenerator($contextGenerator);
            }

            yield $contextGenerator;
        }
    }

    /**
     * @return int
     */
    public function countWords()
    {
        $count = 0;
        foreach ($this->getSetupTextGenerators() as $key => $textGenerator) {
            $count += $textGenerator->countWords();
        }

        return $count;
    }

    /**
     * @param any $data
     *
     * @return string
     */
    public function generate($data): string
    {
        $str = '';
        foreach ($this->getSetupTextGenerators() as $key => $textGenerator) {
            if (array_key_exists('data', $textGenerator)) {
                $str .= $textGenerator->generate($textGenerator['data']);
            } else {
                $str .= $textGenerator->generate($data);
            }
        }

        $str = Spinning::process($str);
        $str = $this->variableToStringService->setDataset($data)->replace($str, $data);

        return $str;
    }
}
