<?php

namespace Generator\Models\ContextGenerator\Base;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface ContextGenerate
{
    /**
     * @param array $data
     *
     * @return string
     */
    public function generate($data): string;
}
