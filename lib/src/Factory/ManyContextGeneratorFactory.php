<?php

namespace Generator\Factory;

use Generator\Models\ContextGenerator\Base\ManyContextGeneratorInterface;

class ManyContextGeneratorFactory
{
   
    public function constructManyContextGenerator( $contextMany )
    {
    
        if (array_key_exists('contexts', $contextMany)) {
            $contextMany['class']->setContexts($contextMany['contexts']);
        }

        return $contextMany['class'];
    }

}
