<?php

namespace Generator\Compose;

use Generator\Models\CanReplaceVariable;
use Generator\Services\VariableToString;

trait DefaultVariableService
{
    public function setDefaultVariableToStringService(): void
    {
        $this->variableToStringService = new VariableToString();
    }

    public function setVariableToStringService(CanReplaceVariable $service){
        $this->variableToStringService = $service;
        return $this;
    }

    /**
     * @return CanReplaceVariable
     */
    public function getVariableToStringService(): CanReplaceVariable
    {
        return $this->variableToStringService;
    }


}
