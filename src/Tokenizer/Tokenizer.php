<?php

namespace Generator\Tokenizer;

class Tokenizer
{
    /** @var string */
    private $re;
    /** @var array */
    private $types;

    /**
     * @param array  $patterns of [(int|string) token type => (string) pattern]
     * @param string $flags    regular expression flags
     */
    public function __construct(array $patterns, string $flags = '')
    {
        $this->regex = '~(' . implode(')|(', $patterns) . ')~U' . $flags;
        $this->types = array_keys($patterns);
    }

    /**
     * Tokenizes string.
     *
     * @throws Exception
     */
    public function tokenize(string $input): Stream
    {
        preg_match_all($this->regex, $input, $tokens, PREG_SET_ORDER);

        $len = 0;
        $count = count($this->types);

        foreach ($tokens as &$token) {
            $type = null;
            for ($i = 1; $i <= $count; ++$i) {
                if (!isset($token[$i])) {
                    break;
                } elseif (null != $token[$i]) {
                    $type = $this->types[$i - 1];
                    break;
                }
            }
           
            $token = new Token($token[0], $type, $len);
            $len += strlen($token->value);
        }
        // var_dump($len);
        // var_dump(strlen($input));
        // var_dump($tokens); die;
        // if ($len !== strlen($input)) {
        //     [$line, $col] = $this->getCoordinates($input, $len);
        //     $token = str_replace("\n", '\n', substr($input, $len, 10));
        //     throw new \Exception("Unexpected '$token' on line $line, column $col.");
        // }

        return new Stream($tokens);
    }

    /**
     * Returns position of token in input string.
     *
     * @return array of [line, column]
     */
    public static function getCoordinates(string $text, int $offset): array
    {
        $text = substr($text, 0, $offset);

        return [substr_count($text, "\n") + 1, $offset - strrpos("\n" . $text, "\n") + 1];
    }
}
