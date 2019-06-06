<?php

namespace Generator\Models\Generator\Base;

use Generator\Helpers\Spinning;
use Generator\Factory\ManyContextGeneratorFactory;
use Generator\Factory\TextGeneratorFactory;
use Generator\Models\ContextGenerator\Base\BaseManyContextGenerator;
use Generator\Models\ContextGenerator\Base\TextGenerate;
use Generator\Models\CanReplaceVariable;
use Generator\Services\VariableToString;

class BaseGenerator implements TextGenerators
{
    protected $textGenerators;

    /**
     *
     * @param array $textGenerators
     * @param array $factories
     * @param CanReplaceVariable $variableToString
     */
    public function __construct(array $textGenerators = [], $factories = [], ?CanReplaceVariable $variableToString = null)
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
            $this->setDefaultVariableToStringService();
        }
        else{
            $this->variableToString = $variableToString;
        }
    }

    /**
     * Create default variable to string service
     * @return void
     */
    public function setDefaultVariableToStringService() : void
    {
        $this->variableToStringService = new VariableToString();
    }

    /**
     * @return void
     */
    public function setDefaultTextGeneratorFactory() : void
    {
        $this->textGeneratorFactory = new TextGeneratorFactory();
    }


    /**
     * @return void
     */
    public function setDefaultManyContextGeneratorFactory() : void
    {
        $this->manyContextGeneratorFactory = new ManyContextGeneratorFactory();
    }

    /**
     * @param array $textGenerators
     * @return $this
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

    /**
     * @return void
     */
    protected function getSetupTextGenerators()
    {
        foreach ($this->getTextGenerators() as $key => $contextGenerator) {
            if (!array_key_exists('class', $contextGenerator)) {
                continue;
            }

            if (array_key_exists('class', $contextGenerator) && is_string($contextGenerator['class'])) {
                $contextGenerator['class'] = new $contextGenerator['class']();
            }

            if ($contextGenerator['class'] instanceof BaseManyContextGenerator) {
                $contextGenerator = $this->manyContextGeneratorFactory->constructManyContextGenerator($contextGenerator);
            } elseif ($contextGenerator['class'] instanceof TextGenerate) {
                $contextGenerator = $this->textGeneratorFactory->constructTextGenerator($contextGenerator);
            }

            yield $contextGenerator;
        }
    }

    /**
     * @return int
     */
    public function countWords() : int
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
