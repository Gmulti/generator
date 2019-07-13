<?php

namespace Generator\Contexts;

use Generator\Models\CanUseContexts;

class Many implements CanUseContexts
{
    protected $contexts = [];

    /**
     * @param array $contexts
     */
    public function __construct(array $contexts = [])
    {
        if (!empty($contexts)) {
            $this->setContexts($contexts);
        }
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
     * @param string        $key
     * @param Single $context
     *
     * @return $this
     */
    public function setContextGeneratorByKey($key, Single $context)
    {
        $this->contexts[$key] = $context;

        return $this;
    }

    /**
     * @param array $data
     *
     * @return string
     */
    public function generate($data): string
    {
        foreach ($this->contexts as $key => $context) {
            $str = $context->generate($data);

            if (empty($str)) {
                continue;
            }

            return $str;
        }

        return '';
    }
}
