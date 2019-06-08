<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Generator\Services\VariableToString;

final class VariableToStringTest extends TestCase
{

    public function testReplaceOneDepth(): void
    {
        $str = "Transform [[foo]] by bar";
        $variableToStringService = new VariableToString();
        $newStr = $variableToStringService->setDataset([
            "foo" => "bar"
        ])->replace($str);
        
        $this->assertEquals('Transform bar by bar', $newStr);
    }

    public function testReplaceManyDepth(): void
    {
        $str = "Transform [[foo#bar]] by salad";
        $variableToStringService = new VariableToString();
        $newStr = $variableToStringService->setDataset([
            "foo" => [
                "bar" => "salad"
            ]
        ])->replace($str);

        $this->assertEquals('Transform salad by salad', $newStr);
    }

    public function testReplaceManyMultipleDepth(): void
    {
        $str = "Transform [[foo#bar]] by salad and [[team#labels#name]] by OL";
        $variableToStringService = new VariableToString();
        $newStr = $variableToStringService->setDataset([
            "foo" => [
                "bar" => "salad"
            ],
            "team" => [
                "labels" => [
                    "name" => "OL"
                ]
            ]
        ])->replace($str);

        $this->assertEquals('Transform salad by salad and OL by OL', $newStr);
    }
  
}
