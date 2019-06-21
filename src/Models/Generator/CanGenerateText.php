<?php

namespace Generator\Models\Generator;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface CanGenerateText
{
    /**
     * @param array $contexts
     */
    public function setContexts(array $contexts);

    /**
     * @return array
     */
    public function getContexts(): array;

    public function generate($data): string;
}
