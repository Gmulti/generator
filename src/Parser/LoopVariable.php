<?php

namespace Generator\Parser;

use Generator\Services\VariableToString;

class LoopVariable extends VariableToString
{
    /**
     * @param string $variable
     */
    public function setBaseVariable(string $variable)
    {
        $this->baseVariable = $variable;

        return $this;
    }

    /**
     * [[home.labels.name]] => $data["home"]["labels"]["name"].
     *
     * @param string $array
     * @param string $dataset
     *
     * @return array
     */
    public function getKeyValueInLoopByKeys($keys, $dataset = null)
    {
        if (null === $dataset) {
            $dataset = $this->dataset;
        }

        if (is_array($keys) && is_array($dataset) && array_key_exists(0, $keys) && array_key_exists($keys[0], $dataset)) {
            $dataset = $dataset[$keys[0]];
            $keys = $this->removeFirstKeyAndClean($keys);

            return $this->getKeyValueInLoopByKeys($keys, $dataset);
        }

        return $dataset;
    }

    /**
     * @param string $variable
     */
    public function getValueInLoopByVariableFromDataSet($variable)
    {
        $keys = explode(self::VARIABLE_SEPARATOR, $variable);

        $filters = $this->variableFilterService->getFiltersFromString(end($keys));
        $keys[count($keys) - 1] = $this->variableFilterService->cleanFiltersForString(end($keys));
        if ($keys[0] !== $this->baseVariable) {
            return $variable;
        }

        if (count($keys) > 1) {
            $keys = $this->removeFirstKeyAndClean($keys);
            $value = $this->getKeyValueInLoopByKeys($keys);
        } elseif (1 === count($keys) && $keys[0] === $this->baseVariable) {
            $value = $this->dataset;
        }

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
            $value = $this->getValueInLoopByVariableFromDataSet($variable);

            if (!is_string($value) && !is_int($value)) {
                continue;
            }

            $string = str_replace($variables[0][$key], $value, $string);
        }

        return $string;
    }
}
