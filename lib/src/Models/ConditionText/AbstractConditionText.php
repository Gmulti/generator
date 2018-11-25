<?php

namespace Generator\Models\ConditionText;

class AbstractConditionText
{
    protected $possibilities = [];

    public function getText($data){

        foreach ($this->possibilities as $key => $possibility) {
            $textGenerator = new $possibility();

            $str = $textGenerator->generate($data);

            if( empty( $str ) ){
                continue;
            }

            return $str;
        }

        return null;

    }
}
