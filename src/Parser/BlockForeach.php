<?php

namespace Generator\Parser;

use Generator\Models\BaseParser;

class BlockForeach extends BaseParser {
    const REGEX = '#(?<start_block>\[% for(?<instructions>(.*?))%\])(?<body>(?:.*))(?<end_block>\[% endfor %\])#';

    public function parse($args){
        list( $text, $token, $data ) = $args;

        preg_match(self::REGEX, $token->value, $matches);

        // @TODO: for like twig
        // $eachElements = preg_split('/\s+/', trim($matches['instructions']));

        $sets = $this->getVariableToStringService()
                      ->setDataSet($data)
                      ->getValueByVariableFromDataSet(trim($matches["instructions"]), true);
        $str = '';
        foreach($sets as $dataset){
            $str .= $this->getVariableToStringService()
                      ->setDataSet($dataset)
                      ->replace($matches['body']);
        }

        return str_replace($matches[0], $str, $text);
    }
}