<?php

namespace Generator\Models\ContextGenerator\Base;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface TextGeneratorInterface
{
    /**
     * @return array
     */
    public function getDataSpecTest(): array;

    /**
     * @param array $dataSpecTest
     */
    public function setDataSpecTest(array $dataSpecTest);

    /**
     * @param string $text
     */
    public function setText(string $text);

    /**
     * @return string
     */
    public function getText(): string;
}
