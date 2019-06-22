<?php

namespace Generator\Models;

abstract class BaseFilter
{
    public function filter($value){
        return $value;
    }
}
