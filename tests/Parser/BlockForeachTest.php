<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Generator\Parser\BlockForeach;
use Generator\Parser\LoopVariable;
use Generator\Tokenizer\Token;
use Generator\Helpers\Tokens;

final class BlockForeachTest extends TestCase
{
    public function testBlockForeachParseWithValue(): void
    {
        $str = 'Transform loop [% for item in teams.best %][[item]] [% endfor %].';

        $token = new Token($str, Tokens::T_FOREACH, 0);
        $item = new BlockForeach();
        $item->setVariableToStringService(new LoopVariable());
        $data = [
            'teams' => [
                'best' => ['OL','OM','PSG']
            ],
        ];
        $newStr = $item->parse([$str, $token,$data]);
        
        $this->assertEquals('Transform loop OL OM PSG .', $newStr);
    }
    
    public function testBlockForeachParseWithComplexObject(): void
    {
        $str = 'Transform loop [% for item in teams.best %][[item.name]] [% endfor %].';

        $token = new Token($str, Tokens::T_FOREACH, 0);
        $item = new BlockForeach();
        $item->setVariableToStringService(new LoopVariable());
        $data = [
            'teams' => [
                'best' => [
                    [
                        'name'      => 'OL',
                    ],
                    [
                        'name'      => 'OM',
                    ],
                    [
                        'name'      => 'PSG',
                    ],
                ]
            ],
        ];
        $newStr = $item->parse([$str, $token,$data]);
        
        $this->assertEquals('Transform loop OL OM PSG .', $newStr);
    }
}
