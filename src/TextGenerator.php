<?php

namespace Generator;

use Generator\Helpers\Spinning;
use Generator\Factory\ManyContextGeneratorFactory;
use Generator\Factory\ContextGeneratorFactory;
use Generator\Models\CanGenerateText;
use Generator\Models\CanReplaceVariable;
use Generator\Models\CanUseContexts;
use Generator\Contexts\Single;
use Generator\Contexts\Many;
use Generator\Services\VariableToString;

class TextGenerator implements CanGenerateText, CanUseContexts
{
    protected $contexts;

    /**
     * @param array              $contexts
     * @param array              $factories
     * @param CanReplaceVariable $variableToString
     */
    public function __construct(array $contexts = [], $factories = [], ?CanReplaceVariable $variableToString = null)
    {
        $this->setContexts($contexts);

        if (!array_key_exists('ManyContextGenerator', $factories)) {
            $this->setDefaultManyContextGeneratorFactory();
        } else {
            $this->manyContextGeneratorFactory = $factories['ManyContextGenerator'];
        }

        if (!array_key_exists('TextGenerator', $factories)) {
            $this->setDefaultTextGeneratorFactory();
        } else {
            $this->contextGeneratorFactory = $factories['TextGenerator'];
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
        $this->contextGeneratorFactory = new ContextGeneratorFactory();
    }

    public function setDefaultManyContextGeneratorFactory(): void
    {
        $this->manyContextGeneratorFactory = new ManyContextGeneratorFactory();
    }

    /**
     * @param array $contexts
     *
     * @return $this
     */
    public function setContexts(array $contexts)
    {
        $this->contexts = $contexts;

        return $this;
    }

    /**
     * @return array
     */
    public function getContexts(): array
    {
        return $this->contexts;
    }

    /**
     * @return string
     */
    public function getClassDefaultContextGenerator(): string
    {
        return '\\Generator\Contexts\\Single';
    }

    /**
     * @return string
     */
    public function getClassDefaultManyContextGenerator(): string
    {
        return '\\Generator\\Contexts\\Many';
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
        foreach ($this->getContexts() as $key => $contextGenerator) {
            $contextGenerator = $this->constructContextGenerator($contextGenerator);

            if ($contextGenerator['class'] instanceof Many) {
                $contextGenerator = $this->manyContextGeneratorFactory->constructManyContextGenerator($contextGenerator);
                foreach ($contextGenerator->getContexts() as $key => $context) {
                    $prepareContext = [];
                    if (is_string($context)) {
                        $prepareContext['class'] = $context;
                    } else {
                        $prepareContext = $context;
                    }

                    $context = $this->constructContextGenerator($prepareContext);
                    $contextGenerator->setContextGeneratorByKey($key, $this->contextGeneratorFactory->constructTextGenerator($context));
                }
            } elseif ($contextGenerator['class'] instanceof Single) {
                $contextGenerator = $this->contextGeneratorFactory->constructTextGenerator($contextGenerator);
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
