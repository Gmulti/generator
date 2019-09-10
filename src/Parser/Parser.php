<?php

namespace Generator\Parser;

use Generator\Tokenizer\Token;
use Generator\Helpers\Tokens;

class Parser
{
    protected $blocks = [];

    public function __call($name, $args)
    {
        if (!array_key_exists($name, $this->blocks)) {
            $item = false;
            switch ($name) {
                case Tokens::T_FOREACH:
                    $item = new BlockForeach();
                    $item->setVariableToStringService(new LoopVariable());
                    break;
            }

            if (!$item) {
                return $args[0];
            }

            $this->blocks[$name] = $item;
        }

        return $this->blocks[$name]->parse($args);
    }

    /**
     * @param Token $token
     *
     * @return string
     */
    public function parse($text, Token $token, $data)
    {
        return $this->{$token->type}($text, $token, $data);
    }
}
