<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

use Generator\Services\VariableFilter;

final class VariableFilterTest extends TestCase
{
    protected function setUp(): void
    {
        $this->data = 1561131208;
    }

    public function testApplyFilters(): void
    {
        $variableFilterService = new VariableFilter();
        $value = $variableFilterService->applyFilters($this->data, [
            'date("Y-m-D")',
            'uppercase'
        ]);
        
        $this->assertEquals('2019-06-FRI', $value);
    }
    public function testExecuteFilter(): void
    {
        $variableFilterService = new VariableFilter();
        $value = $variableFilterService->executeFilter($this->data, 'date("Y-m-D")');
        
        $this->assertEquals('2019-06-Fri', $value);
    }

  
}
