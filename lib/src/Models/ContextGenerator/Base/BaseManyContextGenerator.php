<?php

namespace Generator\Models\ContextGenerator\Base;

class BaseManyContextGenerator implements ContextGeneratorInterface, ManyContextGeneratorInterface
{
    protected $contexts = [];

    public function generate($data): string
    {
        foreach ($this->contexts as $key => $context) {
            $textGenerator = new $context();

            $str = $textGenerator->generate($data);

            if (empty($str)) {
                continue;
            }

            return $str;
        }

        return '';
    }
}
