<?php

namespace Generator\Factory;

use Generator\Models\ContextGenerator\CanUseText;
use Generator\Models\ContextGenerator\CanUseProbability;
use Generator\Models\ContextGenerator\CanUseDataSpec;

class ContextGeneratorFactory
{
    /**
     * @param array $context
     *
     * @throws Exception
     *
     * @return string
     */
    public function constructTextGenerator(array $context)
    {
        if (!array_key_exists('class', $context)) {
            throw new \Exception('Missing class key');
        }

        if (array_key_exists('dataSpecTest', $context) && $context['class'] instanceof CanUseDataSpec) {
            $context['class']->setDataSpecTest($context['dataSpecTest']);
        }

        if (array_key_exists('text', $context) && $context['class'] instanceof CanUseText) {
            $context['class']->setText($context['text']);
        }

        if (array_key_exists('probability', $context) && $context['class'] instanceof CanUseProbability) {
            $context['class']->setProbability($context['probability']);
        }

        return $context['class'];
    }
}
