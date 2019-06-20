<?php

namespace Generator\Models\Generator\Base;

use Generator\Helpers\Spinning;
use Generator\Factory\ManyContextGeneratorFactory;
use Generator\Factory\TextGeneratorFactory;
use Generator\Models\ContextGenerator\Base\ManyContextGenerator;
use Generator\Models\ContextGenerator\Base\TextGenerate;
use Generator\Models\CanReplaceVariable;
use Generator\Services\VariableToString;

class BaseGenerator implements TextGenerators
{
    protected $textGenerators;

    /**
     * @param array              $textGenerators
     * @param array              $factories
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
        } else {
            $this->variableToString = $variableToString;
        }
    }

    /**
     * Create default variable to string service.
     */
    public function setDefaultVariableToStringService(): void
    {
        $this->variableToStringService = new VariableToString();
    }

    public function setDefaultTextGeneratorFactory(): void
    {
        $this->textGeneratorFactory = new TextGeneratorFactory();
    }

    public function setDefaultManyContextGeneratorFactory(): void
    {
        $this->manyContextGeneratorFactory = new ManyContextGeneratorFactory();
    }

    /**
     * @param array $textGenerators
     *
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
     * @return string
     */
    public function getClassDefaultContextGenerator(): string
    {
        return '\\Generator\\Models\\ContextGenerator\\Base\\BaseContextGenerator';
    }

    /**
     * @return string
     */
    public function getClassDefaultManyContextGenerator(): string
    {
        return '\\Generator\\Models\\ContextGenerator\\Base\\ManyContextGenerator';
    }

    /**
     * @param array $context
     *
     * @return array
     */
    public function constructContextGenerator(array $context): array
    {
        if (!array_key_exists('class', $context) && !array_key_exists('contexts', $context)) {
            $context['class'] = $this->getClassDefaultContextGenerator();
        } elseif (!array_key_exists('class', $context) && array_key_exists('contexts', $context)) {
            $context['class'] = $this->getClassDefaultManyContextGenerator();
        }

        if (is_string($context['class'])) {
            $context['class'] = new $context['class']();
        }

        return $context;
    }

    protected function getSetupTextGenerators()
    {
        foreach ($this->getTextGenerators() as $key => $contextGenerator) {
            $contextGenerator = $this->constructContextGenerator($contextGenerator);

            if ($contextGenerator['class'] instanceof ManyContextGenerator) {
                $contextGenerator = $this->manyContextGeneratorFactory->constructManyContextGenerator($contextGenerator);
                foreach ($contextGenerator->getContexts() as $key => $context) {
                    $prepareContext = [];
                    if (is_string($context)) {
                        $prepareContext['class'] = $context;
                    } else {
                        $prepareContext = $context;
                    }

                    $context = $this->constructContextGenerator($prepareContext);
                    $contextGenerator->setContextGeneratorByKey($key, $this->textGeneratorFactory->constructTextGenerator($context));
                }
            } elseif ($contextGenerator['class'] instanceof TextGenerate) {
                $contextGenerator = $this->textGeneratorFactory->constructTextGenerator($contextGenerator);
            }

            yield $contextGenerator;
        }
    }

    /**
     * @return int
     */
    public function countWords(): int
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
            if (!empty($str) || '.' === substr($str, -1)) {
                $str .= ' ';
            }

            if (array_key_exists('data', $textGenerator)) {
                $str .= $textGenerator->generate($textGenerator['data']);
            } else {
                $str .= $textGenerator->generate($data);
            }
        }

        $str = Spinning::process($str);
        $str = $this->variableToStringService->setDataset($data)->replace($str, $data);

        return trim($str);
    }
}
