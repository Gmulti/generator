<?php

namespace Generator\Models\Generator\Base;

/**
 * @version 1.0.0
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface TextGeneratorInterface
{
    /**
    *
    * @param array $data
    * @return string
    */
    public function generate($data) : string;

    /**
     *
     * @return array
     */
    public function getDataSpecTest() : array;

    /**
     *
     * @param array $dataSpecTest
     * @return void
     */
    public function setDataSpecTest(array $dataSpecTest);

    /**
     *
     * @param string $text
     * @return void
     */
    public function setText(string $text);

    /**
     *
     * @return string
     */
    public function getText() : string;
}
