<?php

namespace Generator\Models;

interface CanApplyFilter
{
    /**
     * @param string $str
     *
     * @return array
     */
    public function getFiltersFromString(string $str): array;

    public function executeFilter($value, $filter);

    /**
     * @param array $value
     * @param array $filters
     */
    public function applyFilters($value, array $filters);
}
