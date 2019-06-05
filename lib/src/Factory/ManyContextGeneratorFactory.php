<?php

namespace Generator\Factory;

class ManyContextGeneratorFactory
{   
    /**
     * @param array $contextMany
     * @return Object
     */
    public function constructManyContextGenerator($contextMany)
    {
        if (array_key_exists('contexts', $contextMany)) {
            $contextMany['class']->setContexts($contextMany['contexts']);
        }

        return $contextMany['class'];
    }
}
