<?php

namespace Generator\Factory;

class TextGeneratorFactory
{
    public function constructTextGenerator($context)
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
