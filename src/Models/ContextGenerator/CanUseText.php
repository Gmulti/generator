<?php

namespace Generator\Models\ContextGenerator;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface CanUseText
{
    /**
     * @param string $text
     */
    public function setText(string $text);

    /**
     * @return string
     */
    public function getText(): string;
}
