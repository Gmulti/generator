<?php

namespace Generator\Services;

use Generator\Models\CanReplaceVariable;

class VariableToString implements CanReplaceVariable
{
    const REGEX = "#\[\[(.*?)\]\]#";

    const VARIABLE_SEPARATOR = '#';

    /**
     * @param $variableFilterService
     */
    public function __construct($variableFilterService = null)
    {
        if (is_null($variableFilterService)) {
            $this->createDefaultVariableFilterService();
        } else {
            $this->variableFilterService = $variableFilterService;
        }
    }

    public function createDefaultVariableFilterService()
    {
        $this->variableFilterService = new VariableFilter();
    }

    /**
     * @param array $dataset
     *
     * @return $this
     */
    public function setDataset($dataset)
    {
        $this->dataset = $dataset;

        return $this;
    }

    /**
     * @param string $string
     *
     * @return array
     */
    public function getVariables($string): array
    {
        preg_match_all(self::REGEX, $string, $matches);

        return $matches;
    }

    /**
     * [[home#labels#name]] => $data["home"]["labels"]["name"].
     *
     * @param string $array
     * @param string $dataset
     *
     * @return array
     */
    public function getKeyValueByKeys($keys, $dataset = null)
    {
        if (null === $dataset) {
            $dataset = $this->dataset;
        }

        if (is_array($keys) && is_array($dataset) && array_key_exists(0, $keys) && array_key_exists($keys[0], $dataset)) {
            $dataset = $dataset[$keys[0]];
            unset($keys[0]);
            $keys = array_values($keys);

            return $this->getKeyValueByKeys($keys, $dataset);
        }

        return $dataset;
    }

    /**
     * @param string $variable
     *
     * @return bool
     */
    public function isVariable($variable)
    {
        if (!is_string($variable)) {
            return false;
        }

        if (false === strpos($variable, self::VARIABLE_SEPARATOR)) {
            return false;
        }

        return true;
    }

    /**
     * @param string $variable
     */
    public function getValueByVariableFromDataSet($variable)
    {
        if (!$this->isVariable($variable)) {
            return $variable;
        }

        $keys = explode('#', $variable);

        if (empty($keys[0])) {
            array_shift($keys);
        }

        $filters = $this->variableFilterService->getFiltersFromString(end($keys));
        $keys[count($keys) - 1] = $this->variableFilterService->cleanFiltersForString(end($keys));

        $value = $this->getKeyValueByKeys($keys);

        if (empty($filters)) {
            return $value;
        }

        return $this->variableFilterService->applyFilters($value, $filters);
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function replace($string): string
    {
        $variables = $this->getVariables($string);

        if (!array_key_exists(1, $variables)) {
            return $string;
        }

        foreach ($variables[1] as $key => $variable) {
            $value = $this->getValueByVariableFromDataSet($variable);

            if (!is_string($value) && !is_int($value)) {
                continue;
            }

            $string = str_replace($variables[0][$key], $value, $string);
        }

        return $string;
    }
}
