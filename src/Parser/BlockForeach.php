<?php

namespace Generator\Parser;

use Generator\Models\BaseParser;

class BlockForeach extends BaseParser
{
    const REGEX = '#(?<start_block>\[% for(?<instructions>(.*?))%\])(?<body>(?:.*))(?<end_block>\[% endfor %\])#';

    public function parse($args)
    {
        list($text, $token, $data) = $args;

        preg_match(self::REGEX, $token->value, $matches);

        $eachElements = preg_split('/\s+/', trim($matches['instructions']));

        if (!array_key_exists(2, $eachElements)) {
            return $str;
        }

        $sets = $this->getVariableToStringService()
                      ->setDataSet($data)
                      ->getValueByVariableFromDataSet(trim($eachElements[2]), true);

        $str = '';
        foreach ($sets as $dataset) {
            $str .= $this->getVariableToStringService()
                      ->setDataSet($dataset)
                      ->setBaseVariable($eachElements[0])
                      ->replace($matches['body']);
        }

        return str_replace($matches[0], $str, $text);
    }
}
