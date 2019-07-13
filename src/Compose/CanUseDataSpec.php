<?php

namespace Generator\Compose;

/**
 * @version 1.0.0
 *
 * @since 1.0.0
 *
 * @author Thomas DENEULIN <thomasdeneulin@gmail.com>
 */
interface CanUseDataSpec
{
    /**
     * @return array
     */
    public function getDataSpecTest(): array;

    /**
     * @param array $dataSpecTest
     */
    public function setDataSpecTest(array $dataSpecTest);
}
