<?php

namespace Generator\Models\ContextGenerator;

interface CanUseProbability
{
    /**
     * @param int $probability
     */
    public function setProbability(int $probability);

    /**
     * @return int
     */
    public function getProbability(): int;

    /**
     * @return bool
     */
    public function isPossible(): bool;
}
