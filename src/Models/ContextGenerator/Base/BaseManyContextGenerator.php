<?php

namespace Generator\Models\ContextGenerator\Base;

class BaseManyContextGenerator implements ContextGenerate
{
    protected $contexts = [];

    /**
     * @param array $data
     *
     * @return string
     */
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
