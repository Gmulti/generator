<?php

namespace Generator\Factory;

class ContextGeneratorFactory
{
    /**
     * @param array $context
     *
     * @return string
     */
    public function constructTextGenerator(array $context)
    {
        if (array_key_exists('dataSpecTest', $context)) {
            $context['class']->setDataSpecTest($context['dataSpecTest']);
        }

        if (array_key_exists('text', $context)) {
            $context['class']->setText($context['text']);
        }

        return $context['class'];
    }
}
