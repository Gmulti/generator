<?php

namespace Generator\Services;

class VariableToString
{
    const REGEX = "#\[\[(.*?)\]\]#";

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
     * @param string $array
     * @param string $dataset
     *
     * @return array
     */
    public function getKeyValueByKeys($keys, $dataset = null)
    {
        if ($dataset === null) {
            $dataset = $this->dataset;
        }

        if (array_key_exists(0, $keys)) {
            $dataset = $dataset[$keys[0]];
            unset($keys[0]);
            $keys = array_values($keys);

            return $this->getKeyValueByKeys($keys, $dataset);
        }

        return $dataset;
    }

    /**
     * @param string $string
     *
     * @return string
     */
    public function replace($string)
    {
        $variables = $this->getVariables($string);

        if (!array_key_exists(1, $variables)) {
            return $string;
        }

        foreach ($variables[1] as $key => $variable) {
            $keys = explode('#', $variable);
            $value = $this->getKeyValueByKeys($keys);
            $string = str_replace($variables[0][$key], $value, $string);
        }

        return $string;
    }
}
