<?php

namespace Generator\Models\ContextGenerator\Base;

class ManyContextGenerator implements ContextGenerate
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
     * @param string               $key
     * @param BaseContextGenerator $context
     *
     * @return $this
     */
    public function setContextGeneratorByKey($key, BaseContextGenerator $context)
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
