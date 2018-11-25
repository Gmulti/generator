<?php

namespace Generator\Models\Generator\Base;

use Generator\Helpers\Spinning;

class BaseGenerator implements GeneratorInterface
{
    protected $textGenerators;

    public function __construct(array $textGenerators = [])
    {
        $this->setTextGenerators($textGenerators);
    }

    /**
     *
     * @param array $textGenerators
     * @return void
     */
    public function setTextGenerators(array $textGenerators)
    {
        $this->textGenerators = $textGenerators;
        return $this;
    }

    /**
     *
     * @return array
     */
    public function getTextGenerators() : array
    {
        return $this->textGenerators;
    }

    /**
     *
     * @return void
     */
    protected function getSetupTextGenerators()
    {
        $textGenerators = $this->getTextGenerators();
        foreach ($this->getTextGenerators() as $key => $textGenerator) {
            if (array_key_exists('class', $textGenerator) && is_string($textGenerator['class'])) {
                $textGenerators[$key]['class'] = new $textGenerator['class']();
            }

            if (array_key_exists('dataSpecTest', $textGenerator)) {
                $textGenerators[$key]['class']->setDataSpecTest($textGenerator['dataSpecTest']);
            }

            if (array_key_exists('text', $textGenerator)) {
                $textGenerators[$key]['class']->setText($textGenerator['text']);
            }

            yield $textGenerators[$key]['class'];
        }
    }

    public function countWords()
    {
        $count = 0;
        foreach ($this->getSetupTextGenerators() as $key => $textGenerator) {
            $count += $textGenerator->countWords();
        }

        return $count;
    }

    /**
     *
     * @param any $data
     * @return string
     */
    public function generate($data) : string
    {
        $txt = '';
        foreach ($this->getSetupTextGenerators() as $key => $textGenerator) {
            if (array_key_exists('data', $textGenerator)) {
                $txt .= $textGenerator->generate($textGenerator['data']);
            } else {
                $txt .= $textGenerator->generate($data);
            }
        }

        return Spinning::process($txt);
    }
}
