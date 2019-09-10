<?php

namespace Generator\Tokenizer;

class Token
{

    public $value;

    public $type;

    public $offset;

    /**
     *
     * @param string $value
     * @param string $type
     * @param integer $offset
     */
    public function __construct(string $value, $type, int $offset)
    {
        $this->value = $value;
        $this->type = $type;
        $this->offset = $offset;
    }
}
