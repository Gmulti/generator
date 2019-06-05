<?php

namespace Generator\Models\Generator\Base;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface TextGenerators
{
    /**
     *
     * @param array $textGenerators
     * @return void
     */
    public function setTextGenerators(array $textGenerators);

    /**
     *
     * @return array
     */
    public function getTextGenerators() : array;


    public function generate($data) : string;
}
