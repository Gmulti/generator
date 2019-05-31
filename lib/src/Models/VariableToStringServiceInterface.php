<?php

namespace Generator\Models;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface VariableToStringServiceInterface
{
    public function getVariables($string): array;

    public function getKeyValueByKeys($keys, $dataset = null);

    public function replace($string);
}
