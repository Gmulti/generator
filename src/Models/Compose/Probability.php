<?php

namespace Generator\Models\Compose;

trait Probability
{
    protected $probability = 100;

    /**
     * @param int $probability
     */
    public function setProbability(int $probability)
    {
        if ($probability >= 100) {
            $probability = 99;
        } elseif ($probability <= 0) {
            $probability = 1;
        }

        $this->probability = $probability;

        return $this;
    }

    /**
     * @return int
     */
    public function getProbability(): int
    {
        return $this->probability;
    }

    /**
     * @return bool
     */
    public function isPossible(): bool
    {
        return rand(1, 100) <= $this->getProbability();
    }
}
