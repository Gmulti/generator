<?php

namespace Generator\Compose;

trait Text
{
    protected $text = '';

    /**
     * @param string $text
     */
    public function setText(string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }
}
